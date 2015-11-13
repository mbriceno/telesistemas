<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentOrder extends Model
{
	protected $table = 'payment_orders';

    public static $rules = array(
        'enterprise_id' => 'required',
        'tipo_pago' => 'required',
        'fecha_pago' => 'required|date',
        'periodo' => 'required|max:100|min:3',
        'descripcion' => 'required|max:200|min:3',
        'factura' => 'required|max:200|min:2',
        'monto' => 'required|numeric',
        'payment_status' => 'required'        
    );

    protected $fillable = array('enterprise_id', 'tipo_pago', 
                                'fecha_pago', 'periodo', 'descripcion',
                                'factura', 'monto', 
                                'payment_status');
    public function enterprise()
    {
        return $this->belongsTo('App\Enterprise');
    }
}
