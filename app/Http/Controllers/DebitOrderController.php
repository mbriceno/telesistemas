<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Enterprise;
use App\DebitOrder;
use App\SaleOrder;

class DebitOrderController extends Controller
{
    private $status = array(
        'PND' => 'Pendiente',
        'PDO' => 'Pago realizado',
        'RDO' => 'Rechazado',
        'EPP' => 'Espera por pago',
        'VFP' => 'Verificando Pago',
        'RGP' => 'Reingresar Pago',
        'RMD' => 'Reembolsado',
        'CND' => 'Cancelado',
        'CRD' => 'Creada'
    );
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function debit_list($id){
        $enterprise = Enterprise::find($id);
        $status = $this->status;
        $debits = DebitOrder::where('enterprise_id', $id)->orderBy('fecha_debito')->paginate(10);
        
        return view('debits.index', compact('debits','enterprise','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function create_debit($id){
        $enterprise = Enterprise::find($id);
        $debit = DebitOrder::where('enterprise_id',$enterprise->id)->orderBy('fecha_debito','DESC')->first();
        $now = date('Y-m-d H:m:s');
        $debit_status = $this->status;

        if($debit){ #existe un ultimo debito
            $amount = SaleOrder::where('enterprise_id', $enterprise->id)
                                ->whereBetween('created_at', array($debit->created_at,$now))
                                ->sum('total');
            $period = sprintf('%s - %s ',
                            date("d/m/Y", strtotime($debit->created_at)),
                            date("d/m/Y", strtotime($now)));
        }else{
            $last_payment = '0000-00-00 00:00:00';
            $amount = SaleOrder::where('enterprise_id', $enterprise->id)
                                ->whereBetween('created_at', array($last_payment,$now))
                                ->sum('total');
            $period = sprintf('Desde inicio hasta %s', date("d/m/Y", strtotime($now)));
        }

        return view('debits.create', compact('enterprise',
                                            'debit_status',
                                            'period',
                                            'amount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, DebitOrder::$rules);
        DebitOrder::create($request->all());

        return redirect()
                ->route('admin.pagos-empresas.listado', $request->input('enterprise_id'))
                ->with('message', '<div class="alert alert-success" style="margin-top:15px">Débito registrado con Éxito</div>');
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
        $debit = DebitOrder::find($id);
        $debit_status = $this->status;

        return view('debits.edit', compact('debit','debit_status'));
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
