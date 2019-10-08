<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedRoles();
        $this->seedPermissions();
        $this->assignRolePermissions();
    }

    private function seedRoles()
    {
        if (Role::where('name', 'user')->count() < 1) {
            Role::create(['name' => 'user', 'visible' => 0]);
        }
        if (Role::where('name', 'admin')->count() < 1) {
            Role::create(['name' => 'admin', 'visible' => 0]);
        }
        if (Role::where('name', 'super')->count() < 1) {
            Role::create(['name' => 'super', 'visible' => 0]);
        }
    }

    private function seedPermissions()
    {
        if (Permission::where('name', 'user@index')->where('group', 'user')->count() < 1) {
            Permission::create(['name' => 'user@index', 'group' => 'user']);
        }
        if (Permission::where('name', 'user@show')->where('group', 'user')->count() < 1) {
            Permission::create(['name' => 'user@show', 'group' => 'user']);
        }
        if (Permission::where('name', 'user@create')->where('group', 'user')->count() < 1) {
            Permission::create(['name' => 'user@create', 'group' => 'user']);
        }
        if (Permission::where('name', 'user@edit')->where('group', 'user')->count() < 1) {
            Permission::create(['name' => 'user@edit', 'group' => 'user']);
        }
        if (Permission::where('name', 'user@delete')->where('group', 'user')->count() < 1) {
            Permission::create(['name' => 'user@delete', 'group' => 'user']);
        }

        if (Permission::where('name', 'role@index')->where('group', 'role')->count() < 1) {
            Permission::create(['name' => 'role@index', 'group' => 'role']);
        }
        if (Permission::where('name', 'role@show')->where('group', 'role')->count() < 1) {
            Permission::create(['name' => 'role@show', 'group' => 'role']);
        }
        if (Permission::where('name', 'role@create')->where('group', 'role')->count() < 1) {
            Permission::create(['name' => 'role@create', 'group' => 'role']);
        }
        if (Permission::where('name', 'role@edit')->where('group', 'role')->count() < 1) {
            Permission::create(['name' => 'role@edit', 'group' => 'role']);
        }
        if (Permission::where('name', 'role@delete')->where('group', 'role')->count() < 1) {
            Permission::create(['name' => 'role@delete', 'group' => 'role']);
        }

        if (Permission::where('name', 'logs@index')->where('group', 'logs')->count() < 1) {
            Permission::create(['name' => 'logs@index', 'group' => 'logs']);
        }
        if (Permission::where('name', 'logs@show')->where('group', 'logs')->count() < 1) {
            Permission::create(['name' => 'logs@show', 'group' => 'logs']);
        }

        if (Permission::where('name', 'category@index')->where('group', 'category')->count() < 1) {
            Permission::create(['name' => 'category@index', 'group' => 'category']);
        }
        if (Permission::where('name', 'category@show')->where('group', 'category')->count() < 1) {
            Permission::create(['name' => 'category@show', 'group' => 'category']);
        }
        if (Permission::where('name', 'category@create')->where('group', 'category')->count() < 1) {
            Permission::create(['name' => 'category@create', 'group' => 'category']);
        }
        if (Permission::where('name', 'category@edit')->where('group', 'category')->count() < 1) {
            Permission::create(['name' => 'category@edit', 'group' => 'category']);
        }
        if (Permission::where('name', 'category@delete')->where('group', 'category')->count() < 1) {
            Permission::create(['name' => 'category@delete', 'group' => 'category']);
        }

        if (Permission::where('name', 'post@index')->where('group', 'post')->count() < 1) {
            Permission::create(['name' => 'post@index', 'group' => 'post']);
        }
        if (Permission::where('name', 'post@show')->where('group', 'post')->count() < 1) {
            Permission::create(['name' => 'post@show', 'group' => 'post']);
        }
        if (Permission::where('name', 'post@create')->where('group', 'post')->count() < 1) {
            Permission::create(['name' => 'post@create', 'group' => 'post']);
        }
        if (Permission::where('name', 'post@edit')->where('group', 'post')->count() < 1) {
            Permission::create(['name' => 'post@edit', 'group' => 'post']);
        }
        if (Permission::where('name', 'post@delete')->where('group', 'post')->count() < 1) {
            Permission::create(['name' => 'post@delete', 'group' => 'post']);
        }

        if (Permission::where('name', 'comment@index')->where('group', 'comment')->count() < 1) {
            Permission::create(['name' => 'comment@index', 'group' => 'comment']);
        }
        if (Permission::where('name', 'comment@show')->where('group', 'comment')->count() < 1) {
            Permission::create(['name' => 'comment@show', 'group' => 'comment']);
        }
        if (Permission::where('name', 'comment@create')->where('group', 'comment')->count() < 1) {
            Permission::create(['name' => 'comment@create', 'group' => 'comment']);
        }
        if (Permission::where('name', 'comment@edit')->where('group', 'comment')->count() < 1) {
            Permission::create(['name' => 'comment@edit', 'group' => 'comment']);
        }
        if (Permission::where('name', 'comment@delete')->where('group', 'comment')->count() < 1) {
            Permission::create(['name' => 'comment@delete', 'group' => 'comment']);
        }
    }

    private function assignRolePermissions()
    {
        $role = Role::where('name', 'admin')->first();
        $role->givePermissionTo(['user@index', 'user@show']);
    }
}
