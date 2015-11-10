<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enterprise_id')->unsigned();
            $table->foreign('enterprise_id')
                  ->references('id')
                  ->on('enterprises')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('razon_social');
            $table->string('ci_rif');
            $table->text('direccion');
            $table->string('telefono');
            $table->date('fecha_emision');
            $table->string('nro_orden');
            $table->enum('forma_pago', array('tdc', 'tdd', 'efc', 'chq', 'trf'))->default('tdc');
            $table->float('monto');
            $table->float('iva');
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
