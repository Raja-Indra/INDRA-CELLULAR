<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // Define permissions
        $permissions = [
            'user-list', 'user-create', 'user-edit', 'user-delete',
            'role-list', 'role-create', 'role-edit', 'role-delete',
            'produk-list', 'produk-create', 'produk-edit', 'produk-delete',
            'provider-list', 'provider-create', 'provider-edit', 'provider-delete',
            'catatan_hutang-list', 'catatan_hutang-create', 'catatan_hutang-edit', 'catatan_hutang-delete',
            'dashboard-view'
        ];

        // Create permissions with the default 'web' guard
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create a Super Admin role with a description
        $role = Role::create([
            'name' => 'super-admin',
            'description' => 'Super Administrator with all permissions',
            'guard_name' => 'web'
        ]);
        $role->givePermissionTo(Permission::all());

        // Assign super-admin role to a user (optional, e.g., user with ID 1)
        // $user = \App\Models\User::find(1);
        // if($user) {
        //     $user->assignRole('super-admin');
        // }
    }
}
