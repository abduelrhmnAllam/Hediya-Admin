<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

// Auth
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

// Spatie Permission Events
use Spatie\Permission\Events\RoleAssigned;
use Spatie\Permission\Events\RoleRemoved;
use Spatie\Permission\Events\PermissionAssigned;
use Spatie\Permission\Events\PermissionRemoved;

// Listeners
use App\Listeners\LogAdminAuthentication;
use App\Listeners\LogAdminAuthorizationChanges;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [

        // 🔐 Login / Logout
        Login::class => [
            LogAdminAuthentication::class,
        ],
        Logout::class => [
            LogAdminAuthentication::class,
        ],

        // 🛂 Roles
        RoleAssigned::class => [
            LogAdminAuthorizationChanges::class,
        ],
        RoleRemoved::class => [
            LogAdminAuthorizationChanges::class,
        ],

        // 🔑 Permissions
        PermissionAssigned::class => [
            LogAdminAuthorizationChanges::class,
        ],
        PermissionRemoved::class => [
            LogAdminAuthorizationChanges::class,
        ],
    ];
}
