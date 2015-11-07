<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnterprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enterprises', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plan_id')->unsigned();
            $table->foreign('plan_id')
                  ->references('id')
                  ->on('planes')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('razon_social');
            $table->string('nombre_comercial');
            $table->string('rif');
            $table->text('direccion');
            $table->string('telefono');
            $table->string('email');
            $table->string('web');
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
