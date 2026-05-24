<?php

namespace App\Providers\Filament;

use App\Filament\Resources\BlogPosts\BlogPostResource;
use App\Filament\Widgets\StatsOverview;
use App\Settings\GeneralSettings;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Indigo,
            ])
            // ->viteTheme('resources/css/filament/admin/theme.css')
            ->font('Outfit')
            ->brandName(fn(GeneralSettings $settings) => $settings->site_name ?? 'Boston Logan')
            ->brandLogo(
                fn(GeneralSettings $settings) => $settings->site_logo
                    ? Storage::url($settings->site_logo)
                    : null
            )
            ->darkModeBrandLogo(
                fn(GeneralSettings $settings) => $settings->site_logo
                    ? Storage::url($settings->site_logo)
                    : null
            )
            ->brandLogoHeight('3rem')
            ->sidebarCollapsibleOnDesktop()
            ->spa()

            ->profile()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                // Dashboard::class,
                \App\Filament\Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                // AccountWidget::class,
                // FilamentInfoWidget::class,
                StatsOverview::class,
            ])
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
            ->plugins([
                FilamentShieldPlugin::make(),
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }

    public function boot(): void
    {
        Filament::serving(function () {
            if (Auth::check()) {
                $user = Auth::user();
                if ($user->hasRole('super_admin') || $user->hasRole('Super Admin')) {
                    return;
                }
                $canViewBookings = $user->can('view_any_booking') || $user->can('view_any_bookings::booking');
                $canViewBlogs = $user->can('view_any_blog_post') || $user->can('view_any_blog::post');

                $targetUrl = null;
                if ($canViewBookings && !$canViewBlogs) {
                    $targetUrl = \App\Filament\Resources\Bookings\BookingResource::getUrl('index');
                }
                if ($canViewBlogs && !$canViewBookings) {
                    $targetUrl = url('/admin/blog-posts');
                }
                if ($targetUrl) {
                    config(['filament.home_url' => $targetUrl]);
                    if (request()->path() === 'bookings') {
                        redirect()->to($targetUrl)->send();
                    }
                }
            }
        });
    }
}
