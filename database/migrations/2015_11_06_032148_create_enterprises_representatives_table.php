<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnterprisesRepresentativesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('enterprises_representatives', function(Blueprint $table)
		{

			$table->integer('enterprise_id')->unsigned();
			$table->foreign('enterprise_id')
				  ->references('id')
				  ->on('enterprises')
				  ->onDelete('cascade')
				  ->onUpdate('cascade');
				  
			$table->integer('representative_id')->unsigned();
			$table->foreign('representative_id')
				  ->references('id')
				  ->on('representatives')
				  ->onDelete('cascade')
				  ->onUpdate('cascade');
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
