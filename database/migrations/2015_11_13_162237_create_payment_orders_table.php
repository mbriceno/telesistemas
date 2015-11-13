<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enterprise_id')->unsigned();
            $table->foreign('enterprise_id')
                  ->references('id')
                  ->on('enterprises')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->enum('tipo_pago', array('TRF', 'DPS', 'CHQ', 'EFC'));
            $table->date('fecha_pago');
            $table->string('periodo');
            $table->text('descripcion');
            $table->string('factura');
            $table->float('monto');
            $table->enum('payment_status', array('PND', 'PDO', 'RDO', 'EPP', 'VFP', 'RGP', 'RMD', 'CND', 'CRD'))->default('PND');
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
