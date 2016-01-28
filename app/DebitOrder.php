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
