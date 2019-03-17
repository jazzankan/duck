<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.app', function($view) {
            if(isset(auth()->user()->name)) {
                $username = auth()->user()->name;
                $pageowner = 's startsida';
                if (substr($username, -1) === 's') {
                    $pageowner = ' startsida';
                }
                $view->with('pageowner', $pageowner);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
