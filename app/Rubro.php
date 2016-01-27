<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubro extends Model
{
    //
    use \OwenIt\Auditing\AuditingTrait;
    // Fields you do NOT want to register.
    protected $dontKeepLogOf = ['created_at', 'updated_at'];
    // Tell what actions you want to audit.
    protected $auditableTypes = ['created', 'saved', 'deleted'];

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
}
