<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Importa la clase View
use App\Models\Ubicacion;

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
    public function boot()
    {
        // Define el ViewComposer para la vista 'Intranet/navbar'
        View::composer('Intranet/navbar', function ($view) {
            // Obtén las ubicaciones desde tu modelo
            $ubicaciones = Ubicacion::all();

            // Pasa las ubicaciones a la vista
            $view->with('ubicaciones', $ubicaciones);
        });
    }
}
