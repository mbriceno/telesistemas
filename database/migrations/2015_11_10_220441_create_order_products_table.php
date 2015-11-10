<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sale_order_id')->unsigned();
            $table->foreign('sale_order_id')
                  ->references('id')
                  ->on('sale_orders')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('nombre');
            $table->float('cantidad');
            $table->float('monto');
            $table->boolean('total');
            $table->timestamps();
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
