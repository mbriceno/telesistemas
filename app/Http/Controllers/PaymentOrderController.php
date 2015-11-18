<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PaymentOrder;
use App\Enterprise;
use App\SaleOrder;

class PaymentOrderController extends Controller
{
    private $payment_status = array(
        'PND' => 'Pendiente',
        'PDO' => 'Procesado',
        'RDO' => 'Rechazado',
        'EPP' => 'Espera por pago',
        'VFP' => 'Verificando Pago',
        'RGP' => 'Reingresar Pago',
        'RMD' => 'Reembolsado',
        'CND' => 'Cancelado',
        'CRD' => 'Creada'
    );

    private $payments_methods = array(
        'TRF' => 'Transferencia',
        'DPS' => 'Depósito',
        'CHQ' => 'Cheque',
        'EFC' => 'Efectivo',
    );

    private $tiempo = array(
        'hours' => 'Hora(s)', 
        'days' => 'Día(s)', 
        'weeks' => 'Semana(s)', 
        'months' => 'Mes(es)', 
        'years' => 'Año(s)'
    );

    public function __construct()
    {
        $this->middleware('level:90');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    public function payment_list($id){
        $enterprise = Enterprise::find($id);
        $payment_status = $this->payment_status;
        $payments = PaymentOrder::where('enterprise_id', $id)->orderBy('fecha_pago')->paginate(10);
        
        return view('payments.index', compact('payments','enterprise','payment_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    public function create_payment($id){
        $enterprise = Enterprise::find($id);
        $payment = PaymentOrder::where('enterprise_id',$enterprise->id)->orderBy('fecha_pago','DESC')->first();
        $now = date('Y-m-d');
        $payments_methods = $this->payments_methods;
        $payment_status = $this->payment_status;

        if($payment){ //Existe el ultimo pago
            $last_payment = $payment->fecha_pago;
            $next_payment = date('Y-m-d', strtotime($last_payment . " + " . $payment->enterprise->plan->periodo->tiempo . " " . $payment->enterprise->plan->periodo->lapso ) );

            if($now >= $next_payment){ 
                //La fecha actual es igual o mayor a la del proximo pago
                //hay que generar una orden de pago
                if($payment->enterprise->plan->costo > 0){ //Cobro por plan
                    $to_pay = $payment->enterprise->plan->costo;
                    $last_order = '0000-00-00 00:00:00';
                    $period = sprintf('Pago mes: %s ',
                                date("m/Y", strtotime($next_payment)));
                }else{ //Cobro por porcentaje
                    //Monto entre la fecha de la ultima venta de la ultima orden de pago
                    //y la ultima venta del periodo a cobrar
                    $last_order = SaleOrder::where('enterprise_id', $enterprise->id)->orderBy('created_at','DESC')->first();
                    $amount = SaleOrder::where('enterprise_id', $enterprise->id)
                                        ->whereBetween('created_at', array($payment->ultimo_corte,$last_order->created_at))
                                        ->sum('total');
                    $to_pay = $amount * ($payment->enterprise->plan->porcentaje / 100);
                    $period = sprintf('%s - %s ',
                                date("d/m/Y", strtotime($last_payment)),
                                date("d/m/Y", strtotime($now)));
                }
            }else{
                //Caso de uso para cuando no hay que generar orden de pago
                //es decir no se ha cumplido el periodo de pago del plan
                return redirect()
                        ->route('admin.pagos.listado', $id)
                        ->with('message', '<div class="alert alert-warning" style="margin-top:15px">No hay pagos pendientes por facturar</div>');
            }

        }else{ //Primera vez que la empresa paga
            if($enterprise->plan->costo > 0){ //Cobro por plan
                $to_pay = $enterprise->plan->costo;
                $last_order = '0000-00-00 00:00:00';
                $period = sprintf('Primer pago %s', date("m/Y", strtotime($now)));
            }else{ //Cobro por porcentaje
                //Monto entre la fecha de la ultima venta de la ultima orden de pago
                //y la ultima venta del periodo a cobrar
                $last_order = SaleOrder::where('enterprise_id', $enterprise->id)->orderBy('created_at','DESC')->first();
                $amount = SaleOrder::where('enterprise_id', $enterprise->id)
                                    ->whereBetween('created_at', array('0000-00-00 00:00:00',$last_order->created_at))
                                    ->sum('total');
                $to_pay = $amount * ($enterprise->plan->porcentaje / 100);
                $period = sprintf('Desde inicio hasta %s', date("d/m/Y", strtotime($now)));
            }
        }

        $description = sprintf('%s: %s %s',
                                    $enterprise->plan->nombre, 
                                    $enterprise->plan->tiempo_membresia, 
                                    $this->tiempo[$enterprise->plan->unidad_tiempo]);

        return view('payments.create', compact('enterprise',
                                                'payments_methods',
                                                'payment_status',
                                                'period',
                                                'to_pay',
                                                'last_order',
                                                'description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, PaymentOrder::$rules);
        PaymentOrder::create($request->all());

        return redirect()
                ->route('admin.pagos.listado', $request->input('enterprise_id'))
                ->with('message', '<div class="alert alert-success" style="margin-top:15px">Pago registrado con Éxito</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = PaymentOrder::findOrFail($id);
        $payments_methods = $this->payments_methods;
        $payment_status = $this->payment_status;

        return view('payments.show', compact('payment',
                                            'payments_methods',
                                            'payment_status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = PaymentOrder::find($id);
        $payments_methods = $this->payments_methods;
        $payment_status = $this->payment_status;

        return view('payments.edit', compact('payment',
                                            'payments_methods',
                                            'payment_status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $payment = PaymentOrder::findOrFail($id);
        $data = $request->all();
        $this->validate($request, PaymentOrder::$rules);

        $payment->update($data);
        return redirect()
                ->route('admin.pagos.listado', $request->input('enterprise_id'))
                ->with('message', '<div class="alert alert-success" style="margin-top:15px">Datos actualizados con Éxito</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
