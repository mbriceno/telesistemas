<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentOrder extends Model
{
    use SoftDeletes;

    use \OwenIt\Auditing\AuditingTrait;
    // Fields you do NOT want to register.
    protected $dontKeepLogOf = ['created_at', 'updated_at'];
    // Tell what actions you want to audit.
    protected $auditableTypes = ['created', 'saved', 'deleted'];

    public static $logCustomMessage = '{user.name|Anonymous} {type} Orden de Pago <span class="time">{elapsed_time}</span>';

    public static $logCustomFields = [
        'tipo_pago'  => 'Tipo de pago definido como: {new.tipo_pago}',
        'fecha_pago'  => 'Fecha de pago definido como: {new.fecha_pago}',
        'periodo'  => 'Período definido como: {new.periodo}',
        'descripcion'  => 'Descripción definido como: {new.descripcion}',
        'factura'  => 'Factura definido como: {new.factura}',
        'monto'  => 'Monto definido como: {new.monto}',
        'payment_status'  => 'Estatus de Pago definido como: {new.payment_status}',
    ];
    
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
                                'payment_status','ultimo_corte');
    public function enterprise()
    {
        return $this->belongsTo('App\Enterprise');
    }

    public function payment_transactions(){
        return $this->hasMany('App\PaymentTransaction');
    }
}
