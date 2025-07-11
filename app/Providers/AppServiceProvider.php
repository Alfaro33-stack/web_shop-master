<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Compartir categorías con todas las vistas
        View::composer('layouts.app', function ($view) {
            $categories = Category::where('active', true)->get();
            $view->with('categories', $categories);
        });
        // Usar Bootstrap para la paginación
        Paginator::useBootstrap();
    }
}
