<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;

    use \OwenIt\Auditing\AuditingTrait;
    // Fields you do NOT want to register.
    protected $dontKeepLogOf = ['created_at', 'updated_at'];
    // Tell what actions you want to audit.
    protected $auditableTypes = ['created', 'saved', 'deleted'];
    
    public static $rules = array(
        'nombre' => 'required|max:100|min:3',
        'apellido' => 'required|max:100|min:3',
        'direccion' => 'required|max:200|min:3',
        'ci' => 'required|max:15|min:8',
        'telefono' => 'required|alpha_dash',
        'celular' => 'required|alpha_dash',
        'email' => 'required|email',
        'sexo' => 'required'
    );

    public static $rules_update = array(
        'nombre' => 'required|max:100|min:3',
        'apellido' => 'required|max:100|min:3',
        'direccion' => 'required|max:200|min:3',
        'ci' => 'required|max:15|min:8',
        'telefono' => 'required|alpha_dash',
        'celular' => 'required|alpha_dash',
        'sexo' => 'required'
    );

    protected $fillable = array('nombre', 'apellido', 
                                'direccion', 'ci', 'telefono',
                                'email', 'celular', 
                                'sexo','user_id');

    public function user()
    {
        return $this->belongsTo('User', 'users_id');
    }
}
