<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentTransaction extends Model
{
    use SoftDeletes;

    use \OwenIt\Auditing\AuditingTrait;
    // Fields you do NOT want to register.
    protected $dontKeepLogOf = ['created_at', 'updated_at'];
    // Tell what actions you want to audit.
    protected $auditableTypes = ['created', 'saved', 'deleted'];
    
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
