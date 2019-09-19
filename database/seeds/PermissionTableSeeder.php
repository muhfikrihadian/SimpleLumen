<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$permissions = array(
    		array('description' => 'Dashboard','name' => 'dashboard','group' => 'dashboard'),
    		array('description' => 'Config','name' => 'config-list','group' => 'config'),
    		array('description' => 'Report','name' => 'report-list','group' => 'report')
    	);

    	foreach ($permissions as $permission) {
    		Permission::create($permission);
    	}
    }
}
