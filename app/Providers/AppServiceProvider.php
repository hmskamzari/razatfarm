<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Spatie\Health\Facades\Health;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Checks\Checks\PingCheck;
use Spatie\Health\Checks\Checks\QueueCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use BezhanSalleh\LanguageSwitch\LanguageSwitch;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Illuminate\Support\Facades\Gate;
use RickDBCN\FilamentEmail\Models\Email;
use App\Policies\EmailPolicy;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Email::class, EmailPolicy::class);

        // Force HTTPS if you are on production SSL
        if (config('app.env') === 'production' || str_contains(config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }

        // Force Laravel to generate asset/action URLs with the configured app URL.
        URL::forceRootUrl(config('app.url'));

        // Explicitly register Livewire routes with web middleware.
        // Auto-detection is unreliable; explicit registration is more robust.
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle)->middleware('web');
        });

        Livewire::setScriptRoute(function ($handle) {
            return Route::get('/livewire/livewire.js', $handle)->middleware('web');
        });

        //
        Health::checks([
            OptimizedAppCheck::new(),
            DebugModeCheck::new(),
            EnvironmentCheck::new(),
            UsedDiskSpaceCheck::new(),
            PingCheck::new()->url('https://www.google.com'),
            QueueCheck::new(),
            DatabaseCheck::new(),
        ]);

        // Add RTL support for Arabic
        if (app()->getLocale() === 'ar') {
            view()->share('direction', 'rtl');
        }
        // } else {
        //     view()->share('direction', 'ltr');
        // }

        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['ar', 'en']); // also accepts a closure
        });
    }
}
