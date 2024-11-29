<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Solicitudes; 
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;


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
        View::composer('*', function ($view) {
            $solicitudesCount = Solicitudes::where('estado', 0)->count();
    
            $solicitudesCountAsistente = auth()->check()
            ? Solicitudes::whereIn('estado', [1,2])
                ->where('user_id', auth()->id())
                ->where('leido', false) // Añadimos la condición para la columna leido
                ->count()
            : 0;

            
            
            // Compartir las variables con todas las vistas
            $view->with('solicitudesCount', $solicitudesCount);
            $view->with('solicitudesCountAsistente', $solicitudesCountAsistente);

            //paginación 
            paginator::useBootstrap();
        });
        

    }
    
}
