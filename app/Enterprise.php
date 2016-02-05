<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enterprise extends Model
{
	use SoftDeletes;

    use \OwenIt\Auditing\AuditingTrait;
    // Fields you do NOT want to register.
    protected $dontKeepLogOf = ['created_at', 'updated_at'];
    // Tell what actions you want to audit.
    protected $auditableTypes = ['created', 'saved', 'deleted'];

    public static $logCustomMessage = '{user.name|Anonymous} {type} Empresa <span class="time">{elapsed_time}</span>';

    public static $logCustomFields = [
        'razon_social'  => 'Razón Social definido como: {new.razon_social}',
        'nombre_comercial'  => 'Nombre comercial definido como: {new.nombre_comercial}',
        'direccion'  => 'Dirección definido como: {new.direccion}',
        'rif'  => 'Rif definido como: {new.rif}',
        'telefono'  => 'Teléfono definido como: {new.telefono}',
        'email'  => 'Email definido como: {new.email}',
        'web'  => 'Web definido como: {new.web}',
        'status'  => 'Estatus definido como: {new.status}',
        'plan_id'  => 'Plan definido como: {new.plan_id}',
        'logo'  => 'Logo definido como: {new.logo}',
    ];
	
	protected $dates = ['deleted_at'];

    protected $table = 'enterprises';

    public static $rules = array(
        'razon_social' => 'required|max:100|min:3',
        'nombre_comercial' => 'required|max:100|min:3',
        'direccion' => 'required|max:200|min:3',
        'rif' => 'required',
        'telefono' => 'required|alpha_dash',
        'email' => 'required|email',
        'web' => 'url',
        'status' => 'required',
        'plan_id' => 'required|integer',
        'logo' => 'required|image|mimes:jpeg,gif,png'
    );

    protected $fillable = array('razon_social', 'nombre_comercial', 
                                'direccion', 'rif', 'telefono',
                                'email', 'web', 
                                'status', 'plan_id');
    
    public function plan()
    {
        return $this->belongsTo('App\Plan');
    }

    public function staff()
    {
        return $this->belongsToMany('App\User', 'users_enterprises');
    }

    public function representatives()
    {
        return $this->belongsToMany('App\Representative', 'enterprises_representatives');
    }

    public function bank_account()
    {
        return $this->hasOne('App\BankAccount');
    }

    public function payments() {
        return $this->hasMany('App\PaymentOrder');
    }

    public function sale_orders() {
        return $this->hasMany('App\SaleOrder');
    }
}
