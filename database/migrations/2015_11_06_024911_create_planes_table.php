<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rubro_id')->unsigned();
            $table->foreign('rubro_id')
                  ->references('id')
                  ->on('rubros')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('nombre');
            $table->text('descripcion');
            $table->integer('tiempo_membresia');
            $table->enum('unidad_tiempo', array('hours', 'days', 'weeks', 'months', 'years'))->default('years');
            $table->enum('tipo', array('planes', 'servicios'));
            $table->dateTime('fecha_inicio');
            $table->float('costo');
            $table->float('porcentaje');
            $table->boolean('status');
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
