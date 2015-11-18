<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
	public static $rules = array(
        'payment_order_id' => 'required',
        'tipo_pago' => 'required',
        'fecha_transaccion' => 'required|date',
        'monto' => 'required|numeric',
        'nro_referencia' => 'required|min:5|max:20'
    );

    protected $fillable = array('payment_order_id', 'tipo_pago', 
                                'fecha_transaccion', 'monto', 
                                'nro_referencia');

    public function payment()
    {
        return $this->belongsTo('App\PaymentOrder');
    }
}
