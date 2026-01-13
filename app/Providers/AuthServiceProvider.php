<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {

            // Ensure this is an Admin (admin guard)
            if (! method_exists($user, 'getAuthIdentifier')) {
                return null;
            }

            // Super Admin bypass (from config)
            if (in_array($user->email, config('admin.super_admins', []), true)) {
                return true;
            }

            return null;
        });
    }
}
