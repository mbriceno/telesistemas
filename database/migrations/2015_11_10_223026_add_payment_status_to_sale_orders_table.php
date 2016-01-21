<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentStatusToSaleOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sale_orders', function(Blueprint $table) {
            $table->enum('payment_status', array('PND', 'PDO', 'RDO', 'EPP', 'VFP', 'RGP', 'RMD', 'CND', 'CRD'))->after('forma_pago')->default('PND');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
