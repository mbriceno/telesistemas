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
	
	protected $dates = ['deleted_at'];

    protected $table = 'enterprises';

    public static $rules = array(
        'razon_social' => 'required|max:100|min:3',
        'nombre_comercial' => 'required|max:100|min:3',
        'direccion' => 'required|max:200|min:3',
        'rif' => 'required',
        'telefono' => 'required|alpha_dash',
        'email' => 'required|email',
        'web' => 'required|url',
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
