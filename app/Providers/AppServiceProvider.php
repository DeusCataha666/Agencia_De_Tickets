<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Si la aplicación NO está en entorno local (es decir, está en Railway), fuerza HTTPS.
        // Usamos app()->environment() en lugar de env() para evitar fallos si la configuración está en caché.
        if (app()->environment() !== 'local') {
            URL::forceScheme('https');
        }
    }
}