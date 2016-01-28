<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDebitOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debit_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enterprise_id')->unsigned();
            $table->foreign('enterprise_id')
                  ->references('id')
                  ->on('enterprises')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->float('monto');
            $table->date('fecha_debito');
            $table->string('periodo');
            $table->string('factura');
            $table->string('nro_cuenta_bancaria');
            $table->string('titular_cuenta_bancaria');
            $table->string('cirif_cuenta_bancaria');
            $table->enum('status', array('PND', 'PDO', 'RDO', 'EPP', 'VFP', 'RGP', 'RMD', 'CND', 'CRD'))->default('PND');
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
