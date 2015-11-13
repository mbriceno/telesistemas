<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleOrder extends Model
{
	protected $table = 'sale_orders';

    public static $rules = array(
        'razon_social' => 'required|max:100|min:3',
        'direccion' => 'required|max:200|min:3',
        'ci_rif' => 'required',
        'telefono' => 'required|alpha_dash',
        'forma_pago' => 'required',
        'iva_percentage' => 'required|numeric',
		'monto' => 'required|numeric',
		'iva' => 'required|numeric',
		'total' => 'required|numeric'
    );

	protected $fillable = array('enterprise_id', 'razon_social', 'ci_rif', 
                                'direccion', 'telefono', 'fecha_emision',
                                'nro_orden', 'forma_pago', 
                                'monto', 'iva', 'iva_percentage', 'total');

    public function enterprise()
    {
        return $this->belongsTo('App\Enterprise');
    }
}
