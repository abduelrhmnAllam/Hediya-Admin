<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSetupSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Create Roles (admin guard)
        |--------------------------------------------------------------------------
        */
        $contentRole = Role::firstOrCreate([
            'name' => 'content-admin',
            'guard_name' => 'admin',
        ]);

        $affiliateRole = Role::firstOrCreate([
            'name' => 'affiliate-admin',
            'guard_name' => 'admin',
        ]);

        $hybridRole = Role::firstOrCreate([
            'name' => 'hybrid-admin',
            'guard_name' => 'admin',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Super Admin (no role - full access via config)
        |--------------------------------------------------------------------------
        */
        Admin::create([
            'name'     => 'Super Admin',
            'email'    => 'superadmin@hediya.ai',
            'password' => Hash::make('password'),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Content Admin
        |--------------------------------------------------------------------------
        */
        $contentAdmin = Admin::create([
            'name'     => 'Content Admin',
            'email'    => 'content.admin@hediya.ai',
            'password' => Hash::make('password'),
        ]);
        $contentAdmin->assignRole($contentRole);

        /*
        |--------------------------------------------------------------------------
        | Affiliate Admin
        |--------------------------------------------------------------------------
        */
        $affiliateAdmin = Admin::create([
            'name'     => 'Affiliate Admin',
            'email'    => 'affiliate.admin@hediya.ai',
            'password' => Hash::make('password'),
        ]);
        $affiliateAdmin->assignRole($affiliateRole);

        /*
        |--------------------------------------------------------------------------
        | Hybrid Admin
        |--------------------------------------------------------------------------
        */
        $hybridAdmin = Admin::create([
            'name'     => 'Hybrid Admin',
            'email'    => 'hybrid.admin@hediya.ai',
            'password' => Hash::make('password'),
        ]);
        $hybridAdmin->assignRole($hybridRole);
    }
}
