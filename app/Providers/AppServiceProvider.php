<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

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


        Paginator::useBootstrap();

        View::composer('*', function ($view) {

            $name = "";
            if(Auth::check())
                $name = Auth::user() -> name;

            $view->with('name', $name);
        });
    }
}
