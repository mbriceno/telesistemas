<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PaymentOrder;
use App\Enterprise;
use App\SaleOrder;
use App\PaymentTransaction;

class PaymentTransactionController extends Controller
{
    private $payments_methods = array(
        'TRF' => 'Transferencia',
        'DPS' => 'Depósito',
        'CHQ' => 'Cheque',
        'EFC' => 'Efectivo',
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function payment_record($id){
        $payment = PaymentOrder::find($id);
        $payments_methods = $this->payments_methods;
        
        $payment_record = $payment->payment_transactions->sum('monto');
        $to_pay = $payment->monto - $payment_record;

        return view('transactions.create', compact('id','payments_methods','payment','to_pay'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, PaymentTransaction::$rules);
        $payment = PaymentOrder::findOrFail($request->input('payment_order_id'));
        $payment->tipo_pago = $request->input('tipo_pago');
        $payment_record = $payment->payment_transactions->sum('monto') + floatval($request->input('monto'));
        if( $payment->monto == $payment_record ){
            $payment->payment_status = 'VFP';
        }elseif( $payment->monto > $payment_record ){
            $payment->payment_status = 'EPP';
        }else{
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('message', '<div class="alert alert-danger" style="margin-top:15px">El monto a pagar excede el pago</div>');
        }
        
        $payment->save();
        PaymentTransaction::create($request->all());

        return redirect()
                ->route('admin.pagos.listado', $payment->enterprise->id)
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
