<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminRolesSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate([
            'name' => 'content-admin',
            'guard_name' => 'admin',
        ]);

        Role::firstOrCreate([
            'name' => 'affiliate-admin',
            'guard_name' => 'admin',
        ]);

        Role::firstOrCreate([
            'name' => 'hybrid-admin',
            'guard_name' => 'admin',
        ]);
    }
}
