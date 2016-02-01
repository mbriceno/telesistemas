<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
	use SoftDeletes;

	use \OwenIt\Auditing\AuditingTrait;
	// Fields you do NOT want to register.
    protected $dontKeepLogOf = ['created_at', 'updated_at'];
    // Tell what actions you want to audit.
    protected $auditableTypes = ['created', 'saved', 'deleted'];
    
    public static $logCustomMessage = '{user.name|Anonymous} {type} Banco <span class="time">{elapsed_time}</span>';

    public static $logCustomFields = [
        'nombre'  => 'Nombre definido como: {new.nombre}',
    ];

    public static $rules = array(
        'nombre' => 'required|max:100|min:3'
    );

    protected $fillable = array('nombre');
}
