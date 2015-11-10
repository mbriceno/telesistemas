<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Role;
use Bican\Roles\Models\Permission;

class PermissionRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role5 = Role::find(5);
        $role6 = Role::find(6);
        $role7 = Role::find(7);
        $role8 = Role::find(8);

		$role5->attachPermission(array(1,2));
		$role6->attachPermission(array(3,4,5,6,7,8,9,10,11));
		$role7->attachPermission(array(8,9,10,11));
		$role8->attachPermission(array(12,13));
    }
}
