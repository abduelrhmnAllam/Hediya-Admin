<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\DashboardStats;
use Filament\Http\Middleware\Authenticate as FilamentAuthenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            /*
             |--------------------------------------------------------------------------
             | Base Panel Configuration
             |--------------------------------------------------------------------------
             */
             // Restores the default Filament panel styling
            ->default() 
            ->id('admin')
            ->path('admin')

            /*
             |--------------------------------------------------------------------------
             | Authentication
             |--------------------------------------------------------------------------
             */
            ->login()                 // Enables Filament login routes
            ->authGuard('admin')      // Use the custom "admin" auth guard

            /*
             |--------------------------------------------------------------------------
             | Branding
             |--------------------------------------------------------------------------
             */
            ->brandName('Hediya Admin')
            ->brandLogo(asset('images/logo.png'))

            /*
             |--------------------------------------------------------------------------
             | Theme & Colors
             |--------------------------------------------------------------------------
             */
            ->colors([
                'primary' => [
                    50  => '#FFF1EE',
                    100 => '#FFE4DE',
                    200 => '#FFC9BC',
                    300 => '#FFA99A',
                    400 => '#FF7A63',
                    500 => '#FF5A3C',
                    600 => '#F24E1E',
                    700 => '#E94B35',
                    800 => '#C23A28',
                    900 => '#9E2F22',
                ],
            ])

            ->sidebarCollapsibleOnDesktop() // Allow sidebar collapse on desktop

            /*
             |--------------------------------------------------------------------------
             | Resources, Pages & Widgets Discovery
             |--------------------------------------------------------------------------
             */
            ->discoverResources(
                in: app_path('Filament/Resources'),
                for: 'App\Filament\Resources'
            )
            ->discoverPages(
                in: app_path('Filament/Pages'),
                for: 'App\Filament\Pages'
            )
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(
                in: app_path('Filament/Widgets'),
                for: 'App\Filament\Widgets'
            )
            ->widgets([
                AccountWidget::class,
                DashboardStats::class,
            ])

            /*
             |--------------------------------------------------------------------------
             | Global Middleware Stack (without authentication)
             |--------------------------------------------------------------------------
             */
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])

            /*
             |--------------------------------------------------------------------------
             | Filament Authentication Middleware
             |--------------------------------------------------------------------------
             | IMPORTANT:
             | Use Filament's Authenticate middleware only.
             | Do NOT use Laravel's default Authenticate middleware here.
             */
            ->authMiddleware([
                FilamentAuthenticate::class,
            ]);
    }
}
