<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bank_id')->unsigned();
            $table->foreign('bank_id')
                  ->references('id')
                  ->on('banks')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('nro_cuenta');
            $table->string('titular');
            $table->enum('tipo', array('CO', 'AH', 'EL'))->default('CO');
            $table->string('rif_ci');
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
