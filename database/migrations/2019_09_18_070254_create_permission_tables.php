<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;

class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');

        Schema::create($tableNames['permissions'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->string('name');
            $table->string('group');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create($tableNames['roles'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames) {
            $table->unsignedInteger('permission_id');

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type', ], 'model_has_permissions_model_id_model_type_index');

            $table->foreign('permission_id')
            ->references('id')
            ->on($tableNames['permissions'])
            ->onDelete('cascade');

            $table->primary(['permission_id', $columnNames['model_morph_key'], 'model_type'],
                'model_has_permissions_permission_model_type_primary');
        });

        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames) {
            $table->unsignedInteger('role_id');

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type', ], 'model_has_roles_model_id_model_type_index');

            $table->foreign('role_id')
            ->references('id')
            ->on($tableNames['roles'])
            ->onDelete('cascade');

            $table->primary(['role_id', $columnNames['model_morph_key'], 'model_type'],
                'model_has_roles_role_model_type_primary');
        });

        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->unsignedInteger('permission_id');
            $table->unsignedInteger('role_id');

            $table->foreign('permission_id')
            ->references('id')
            ->on($tableNames['permissions'])
            ->onDelete('cascade');

            $table->foreign('role_id')
            ->references('id')
            ->on($tableNames['roles'])
            ->onDelete('cascade');

            $table->primary(['permission_id', 'role_id'], 'role_has_permissions_permission_id_role_id_primary');
        });

        app('cache')
        ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
        ->forget(config('permission.cache.key'));

        $permissions = array(
            array('description' => 'Config','name' => 'config-list','group' => 'config'),
            array('description' => 'Report','name' => 'report-list','group' => 'report'),

            array('description' => 'User List', 'name' => 'user-list', 'group' => 'user'),
            array('description' => 'User Create', 'name' => 'user-create', 'group' => 'user'),
            array('description' => 'User Edit', 'name' => 'user-edit', 'group' => 'user'),
            array('description' => 'User Delete', 'name' => 'user-delete', 'group' => 'user'),

            array('description' => 'Role List', 'name' => 'role-list', 'group' => 'role'),
            array('description' => 'Role Create', 'name' => 'role-create', 'group' => 'role'),
            array('description' => 'Role Edit', 'name' => 'role-edit', 'group' => 'role'),
            array('description' => 'Role Delete', 'name' => 'role-delete', 'group' => 'role'),

            array('description' => 'Merchant List', 'name' => 'merchant-list', 'group' => 'merchant'),
            array('description' => 'Merchant Create', 'name' => 'merchant-create', 'group' => 'merchant'),
            array('description' => 'Merchant Edit', 'name' => 'merchant-edit', 'group' => 'merchant'),
            array('description' => 'Merchant Delete', 'name' => 'merchant-delete', 'group' => 'merchant'),

            array('description' => 'Terminal List', 'name' => 'terminal-list', 'group' => 'terminal'),
            array('description' => 'Terminal Create', 'name' => 'terminal-create', 'group' => 'terminal'),
            array('description' => 'Terminal Edit', 'name' => 'terminal-edit', 'group' => 'terminal'),
            array('description' => 'Terminal Delete', 'name' => 'terminal-delete', 'group' => 'terminal'),

            array('description' => 'Location List', 'name' => 'location-list', 'group' => 'location'),
            array('description' => 'Location Create', 'name' => 'location-create', 'group' => 'location'),
            array('description' => 'Location Edit', 'name' => 'location-edit', 'group' => 'location'),
            array('description' => 'Location Delete', 'name' => 'location-delete', 'group' => 'location'),
        );

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('permission.table_names');

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }
}
