<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(array(
			0 => array(
				'name' => 'SuperAdmin',
				'slug' => 'superadmin',
				'description' => 'Role supervisor'
			),
			1 => array(
				'name' => 'Telesistemas',
				'slug' => 'telesistemas',
				'description' => 'Administrador del sistema'
			),
			2 => array(
				'name' => 'Administrador - Empresas',
				'slug' => 'empresas.administrador',
				'description' => 'Usuario Administrador para las empresas'
			),
			3 => array(
				'name' => 'Vendedor - Empresas',
				'slug' => 'empresas.vendedor',
				'description' => 'Usuario Vendedor para las empresas'
			)
        ));
    }
}
