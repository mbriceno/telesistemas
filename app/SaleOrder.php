<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleOrder extends Model
{
	protected $table = 'sale_orders';

	protected $fillable = array('razon_social', 'ci_rif', 
                                'direccion', 'telefono', 'fecha_emision',
                                'nro_orden', 'forma_pago', 
                                'monto', 'iva', 'total');

    public function enterprise()
    {
        return $this->belongsTo('App\Enterprise');
    }
}
