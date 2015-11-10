<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_products';

    public function order()
    {
        return $this->belongsTo('App\SaleOrder');
    }
}
