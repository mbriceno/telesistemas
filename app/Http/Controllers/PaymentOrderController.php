<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PaymentOrder;
use App\Enterprise;

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
        $plan_costo = ($enterprise->plan->costo > 0)? $enterprise->plan->costo:0;
        $payments_methods = $this->payments_methods;
        $payment_status = $this->payment_status;
        $tiempo = $this->tiempo;

        return view('payments.create', compact('enterprise','payments_methods','payment_status','tiempo','plan_costo'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
