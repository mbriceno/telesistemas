<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleOrder extends Model
{
    use SoftDeletes;

    use \OwenIt\Auditing\AuditingTrait;
    // Fields you do NOT want to register.
    protected $dontKeepLogOf = ['created_at', 'updated_at'];
    // Tell what actions you want to audit.
    protected $auditableTypes = ['created', 'saved', 'deleted'];

    public static $logCustomMessage = '{user.name|Anonymous} {type} Orden de Venta <span class="time">{elapsed_time}</span>';

    public static $logCustomFields = [
        'razon_social'  => 'Cliente definido como: {new.razon_social}',
        'ci_rif'  => 'CI definido como: {new.ci_rif}',
        'direccion'  => 'Direccion definido como: {new.direccion}',
        'telefono'  => 'Telefono definido como: {new.telefono}',
        'fecha_emision'  => 'Fecha de emisión definido como: {new.fecha_emision}',
        'nro_orden'  => 'Orden definido como: {new.nro_orden}',
        'forma_pago'  => 'Forma de pago definido como: {new.forma_pago}',
        'monto' => 'Monto de compra definida como: {new.monto}',
        'total' => 'Total definido como {new.total}'
    ];
    
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
        return $this->belongsTo('App\Enterprise')->withTrashed();
    }
}
