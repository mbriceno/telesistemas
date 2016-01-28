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
