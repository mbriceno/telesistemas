<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
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
