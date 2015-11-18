<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTransactiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_order_id')->unsigned();
            $table->foreign('payment_order_id')
                  ->references('id')
                  ->on('payment_orders')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->date('fecha_transaccion');
            $table->enum('tipo_pago', array('TRF', 'DPS', 'CHQ', 'EFC'));
            $table->string('nro_referencia');
            $table->float('monto');
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
