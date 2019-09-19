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
    }

    private function assignRolePermissions()
    {
        $role = Role::where('name', 'admin')->first();
        $role->givePermissionTo(['user@index', 'user@show']);
    }
}
