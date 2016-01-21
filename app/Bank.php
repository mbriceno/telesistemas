<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    public static $rules = array(
        'nombre' => 'required|max:100|min:3'
    );

    protected $fillable = array('nombre');
}
