<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends Model
{
    use SoftDeletes;

    use \OwenIt\Auditing\AuditingTrait;
    // Fields you do NOT want to register.
    protected $dontKeepLogOf = ['created_at', 'updated_at'];
    // Tell what actions you want to audit.
    protected $auditableTypes = ['created', 'saved', 'deleted'];

    public static $logCustomMessage = '{user.name|Anonymous} {type} Cuenta Bancaria <span class="time">{elapsed_time}</span>';

    public static $logCustomFields = [
        'titular'  => 'Titular definido como: {new.titular}',
        'nro_cuenta'  => 'Número de cuenta definido como: {new.nro_cuenta}',
        'tipo'  => 'Tipo definido como: {new.tipo}',
        'rif_ci'  => 'CI/RIF definido como: {new.rif_ci}',
        'bank_id'  => 'Banco definido como: {new.bank_id}',
        'enterprise_id'  => 'Empresa definido como: {new.enterprise_id}',
    ];
    
    protected $table = 'bank_accounts';

    public static $rules = array(
        'titular' => 'required|max:100|min:3',
        'nro_cuenta' => 'required|digits:20',
        'tipo' => 'required|max:2',
        'rif_ci' => 'required|max:15|min:8',
        'bank_id' => 'required',
        'enterprise_id' => 'required'
    );

    protected $fillable = array('titular', 'nro_cuenta', 
                                'tipo', 'rif_ci', 'bank_id', 'enterprise_id');

    public function bank()
    {
        return $this->belongsTo('App\Bank');
    }

    public function enterprise()
    {
        return $this->belongsTo('App\Enterprise');
    }
}
