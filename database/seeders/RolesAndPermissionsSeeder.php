<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder; // ← السطر المهم
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',

            'view categories',
            'create categories',
            'edit categories',
            'delete categories',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $editor = Role::firstOrCreate(['name' => 'editor']);

        $admin->givePermissionTo(Permission::all());
        $editor->givePermissionTo([
            'view categories',
            'create categories',
            'edit categories',
        ]);
    }
}
