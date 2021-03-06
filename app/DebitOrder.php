<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DebitOrder extends Model
{
    use SoftDeletes;

    use \OwenIt\Auditing\AuditingTrait;
    // Fields you do NOT want to register.
    protected $dontKeepLogOf = ['created_at', 'updated_at'];
    // Tell what actions you want to audit.
    protected $auditableTypes = ['created', 'saved', 'deleted'];

    public static $logCustomMessage = '{user.name|Anonymous} {type} Orden de débito <span class="time">{elapsed_time}</span>';

    public static $logCustomFields = [
        'fecha_debito'  => 'Fecha debito definido como: {new.fecha_debito}',
        'periodo'  => 'Periodo definido como: {new.periodo}',
        'factura'  => 'Factura definido como: {new.factura}',
        'monto'  => 'Monto definido como: {new.monto}',
        'nro_cuenta_bancaria'  => 'Número cuenta definido como: {new.nro_cuenta_bancaria}',
        'cirif_cuenta_bancaria'  => 'CI/RIF cuenta definido como: {new.cirif_cuenta_bancaria}',
        'titular_cuenta_bancaria'  => 'Titular cuenta definido como: {new.titular_cuenta_bancaria}',
        'status'  => 'Estatus definido como: {new.status}',
        'enterprise_id'  => 'Empresa definido como: {new.enterprise_id}',
    ];
    
	protected $table = 'debit_orders';

	public static $rules = array(
        'enterprise_id' => 'required',
        'fecha_debito' => 'required|date',
        'periodo' => 'required|max:100|min:3',
        'factura' => 'required|max:200|min:2',
        'monto' => 'required|numeric',
        'nro_cuenta_bancaria' => 'required|max:50|min:20',
        'titular_cuenta_bancaria' => 'required|max:100|min:3',
        'cirif_cuenta_bancaria' => 'required|max:15|min:8',
        'status' => 'required'
    );

	protected $fillable = array('enterprise_id','fecha_debito','periodo',
                                'factura','monto','nro_cuenta_bancaria',
                                'titular_cuenta_bancaria','cirif_cuenta_bancaria','status');

    public function enterprise()
    {
        return $this->belongsTo('App\Enterprise');
    }
}
