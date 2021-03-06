<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
	use SoftDeletes;

    use \OwenIt\Auditing\AuditingTrait;
    // Fields you do NOT want to register.
    protected $dontKeepLogOf = ['created_at', 'updated_at'];
    // Tell what actions you want to audit.
    protected $auditableTypes = ['created', 'saved', 'deleted'];

    public static $logCustomMessage = '{user.name|Anonymous} {type} Plan <span class="time">{elapsed_time}</span>';

    public static $logCustomFields = [
        'nombre'  => 'Nombre definido como: {new.nombre}',
        'descripcion'  => 'Descripción definido como: {new.descripcion}',
        'status'  => 'Estatus definido como: {new.status}',
        'costo'  => 'costo definido como: {new.costo}',
        'porcentaje'  => 'Porcentaje definido como: {new.porcentaje}',
        'rubro_id'  => 'Rubro definido como: {new.rubro_id}',
        'tiempo_membresia'  => 'Tiempo de membresia definido como: {new.tiempo_membresia}',
        'unidad_tiempo'  => 'Unidad de tiempo definido como: {new.unidad_tiempo}',
        'tipo'  => 'Tipo definido como: {new.tipo}',
        'period_id'  => 'Período definido como: {new.period_id}',
    ];
    
	protected $dates = ['deleted_at'];

	protected $table = 'planes';

    public static $rules = array(
        'nombre' => 'required|max:100|min:3',
        'descripcion' => 'required|max:200|min:3',
        'status' => 'required',
        'costo' => 'required|numeric',
        'porcentaje' => 'required|numeric',
        'rubro_id' => 'required',
        'tiempo_membresia' => 'required|integer',
        'unidad_tiempo' => 'required',
        'tipo' => 'required',
        'period_id' => 'required'
    );

    protected $fillable = array('nombre', 'descripcion', 
                                'status', 'costo', 'porcentaje',
                                'rubro_id', 'tiempo_membresia', 
                                'unidad_tiempo', 'tipo', 'period_id');
	
    public function enterprises()
    {
        return $this->hasMany('App\Enterprise');
    }

    public function rubro()
    {
        return $this->belongsTo('App\Rubro');
    }

    public function periodo()
    {
        return $this->belongsTo('App\Period','period_id');
    }
}
