<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rubro extends Model
{
    use SoftDeletes;

    use \OwenIt\Auditing\AuditingTrait;
    // Fields you do NOT want to register.
    protected $dontKeepLogOf = ['created_at', 'updated_at'];
    // Tell what actions you want to audit.
    protected $auditableTypes = ['created', 'saved', 'deleted'];

    public static $logCustomMessage = '{user.name|Anonymous} {type} Rubro <span class="time">{elapsed_time}</span>';

    public static $logCustomFields = [
        'nombre'  => 'El nombre fue definido como: {new.nombre}', // with callback method
        'descripcion' => 'Descripción definida como: {new.descripcion}',
        'status' => 'Estatus definido como {new.status||getNewStatus}'
    ];

    public static $rules = array(
		'nombre' => 'required|max:100|min:3',
		'descripcion' => 'required|max:200|min:3',
		'status' => 'required'
	);

    protected $fillable = array('nombre', 'descripcion', 'status');

    public function planes()
    {
        return $this->hasMany('App\Plan');
    }

    public function getNewStatus($log)
    {
        if(isset($log->new['status'])){
            return ($log->new['status'])?'Activo':'Desactivado';
        }else{
            return False;
        }
    }
}
