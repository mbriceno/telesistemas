<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert(array(
			0 => array(
				'name' => 'Crud de Roles',
	   			'slug' => 'crud.roles'
			),
			1 => array(
				'name' => 'Crud de Permisos',
				'slug' => 'crud.permissions'
			),
			2 => array(
				'name' => 'Crud de Empresas',
				'slug' => 'crud.empresas'
			),
			3 => array(
				'name' => 'Crud de Planes para empresas',
				'slug' => 'crud.planes'
			),
			4 => array(
				'name' => 'Crud de rubros de empresas',
				'slug' => 'crud.rubros'
			),
			5 => array(
				'name' => 'Crud de bancos',
				'slug' => 'crud.bancos'
			),
			6 => array(
				'name' => 'Crud de cuentas',
				'slug' => 'crud.cuentas'
			),
			7 => array(
				'name' => 'Crud de usuarios de empresas',
				'slug' => 'crud.empresas.usuarios'
			),
			8 => array(
				'name' => 'Crud de pagos de empresas',
				'slug' => 'crud.pagos'
			),
			9 => array(
				'name' => 'Crud de reportes',
				'slug' => 'crud.reportes'
			),
			10 => array(
				'name' => 'Crud de auditorias',
				'slug' => 'crud.auditorias'
			),
			11 => array(
				'name' => 'Crud de registro de ventas',
				'slug' => 'crud.ventas'
			),
			12 => array(
				'name' => 'Crud de perfil de vendedores',
				'slug' => 'crud.perfil.vendedor'
			),
        ));
    }
}
