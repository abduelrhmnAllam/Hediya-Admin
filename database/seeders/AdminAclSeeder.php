<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminAclSeeder extends Seeder
{
    public function run(): void
    {
        /*
         |--------------------------------------------------------------------------
         | Define Permissions (Admin Guard Only)
         |--------------------------------------------------------------------------
         */
        $permissions = [

            /*
             |--------------------------------------------------------------------------
             | Dashboard
             |--------------------------------------------------------------------------
             */
            'view_dashboard',

            /*
             |--------------------------------------------------------------------------
             | Users
             |--------------------------------------------------------------------------
             */
            'view_users',
            'create_users',
            'edit_users',
            'delete_users',

            /*
             |--------------------------------------------------------------------------
             | Interests
             |--------------------------------------------------------------------------
             */
            'view_interests',
            'create_interests',
            'edit_interests',
            'delete_interests',

            /*
             |--------------------------------------------------------------------------
             | Occasions
             |--------------------------------------------------------------------------
             */
            'view_occasions',
            'create_occasions',
            'edit_occasions',
            'delete_occasions',

            /*
             |--------------------------------------------------------------------------
             | Avatars
             |--------------------------------------------------------------------------
             */
            'view_avatars',
            'create_avatars',
            'edit_avatars',
            'delete_avatars',

            /*
             |--------------------------------------------------------------------------
             | Earnings / Revenue
             |--------------------------------------------------------------------------
             */
            'view_earnings',
            'export_earnings',
            'view_affiliate_reports',

            /*
             |--------------------------------------------------------------------------
             | Coupons
             |--------------------------------------------------------------------------
             */
            'view_coupons',
            'create_coupons',
            'edit_coupons',
            'delete_coupons',
            'activate_coupons',
        ];

        /*
         |--------------------------------------------------------------------------
         | Create Permissions
         |--------------------------------------------------------------------------
         */
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'admin',
            ]);
        }

        /*
         |--------------------------------------------------------------------------
         | Create Roles
         |--------------------------------------------------------------------------
         */
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'admin',
        ]);

        $editorRole = Role::firstOrCreate([
            'name' => 'editor',
            'guard_name' => 'admin',
        ]);

        $viewerRole = Role::firstOrCreate([
            'name' => 'viewer',
            'guard_name' => 'admin',
        ]);

        /*
         |--------------------------------------------------------------------------
         | Assign Permissions to Roles
         |--------------------------------------------------------------------------
         */

        // 🔥 Admin: Full access
        $adminRole->syncPermissions(Permission::all());

        // ✏️ Editor: Manage content & limited finance
        $editorRole->syncPermissions([
            'view_dashboard',

            // Users
            'view_users',
            'edit_users',

            // Interests
            'view_interests',
            'edit_interests',

            // Occasions
            'view_occasions',
            'edit_occasions',

            // Avatars
            'view_avatars',
            'edit_avatars',

            // Earnings
            'view_earnings',

            // Coupons
            'view_coupons',
            'create_coupons',
            'edit_coupons',
        ]);

        // 👁️ Viewer: Read-only
        $viewerRole->syncPermissions([
            'view_dashboard',

            // Users
            'view_users',

            // Interests
            'view_interests',

            // Occasions
            'view_occasions',

            // Avatars
            'view_avatars',

            // Earnings
            'view_earnings',

            // Coupons
            'view_coupons',
        ]);
    }
}
