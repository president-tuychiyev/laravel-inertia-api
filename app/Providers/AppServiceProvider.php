<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

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
        Vite::prefetch(concurrency: 3);
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        App::setLocale(strtolower(request()->header('app-language') ?? 'uz'));

        if ($this->app->environment('production') || $this->app->environment('develop')) {
            URL::forceScheme('https');
        }
    }
}
