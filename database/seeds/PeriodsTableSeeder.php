<?php

use Illuminate\Database\Seeder;

class PeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('periods')->insert(array(
			0 => array(
				'nombre' => 'Diario',
	   			'short_name' => 'DIA',
	   			'status' => 1
			),
			1 => array(
				'nombre' => 'Quincenal',
	   			'short_name' => 'QCN',
	   			'status' => 1
			),
			2 => array(
				'nombre' => 'Mensual',
	   			'short_name' => 'MSL',
	   			'status' => 1
			),
			3 => array(
				'nombre' => 'Bimestral',
	   			'short_name' => '2MSL',
	   			'status' => 1
			),
			4 => array(
				'nombre' => 'Trimestral',
	   			'short_name' => '3MSL',
	   			'status' => 1
			),
			5 => array(
				'nombre' => 'Cuatrimestral',
	   			'short_name' => '4MSL',
	   			'status' => 1
			),
			6 => array(
				'nombre' => 'Semestral',
	   			'short_name' => '6MSL',
	   			'status' => 1
			),
			7 => array(
				'nombre' => 'Anual',
	   			'short_name' => 'ANL',
	   			'status' => 1
			)
        ));
    }
}
