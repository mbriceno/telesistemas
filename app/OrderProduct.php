<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProduct extends Model
{
    use SoftDeletes;

	use \OwenIt\Auditing\AuditingTrait;
    protected $auditEnabled  = false;
	// Fields you do NOT want to register.
    protected $dontKeepLogOf = ['created_at', 'updated_at'];
    // Tell what actions you want to audit.
    protected $auditableTypes = ['created', 'saved', 'deleted'];
    
    protected $table = 'order_products';

    public function order()
    {
        return $this->belongsTo('App\SaleOrder');
    }
}
