<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubro extends Model
{
    //
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
