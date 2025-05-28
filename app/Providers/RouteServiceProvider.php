<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Définir les routes de votre application.
     */
    public function boot(): void
    {
          // Définition des groupes de routes pour l'application
        $this->routes(function () {
             // Groupe de routes API, préfixées par 'api' et utilisant le middleware 'api'
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
            
            // Groupe de routes web, utilisant le middleware 'web'
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}

