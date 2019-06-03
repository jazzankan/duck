<?php

namespace App\Providers;

use App\User;
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
    public function sharing($myname, $project)
    {
        $sharing = array();
        $user = User::all();
        foreach($user as $u) {
            foreach($u->projects as $p) {
                if ($p->id == $project->id) {
                    array_push($sharing, $u->name);
                }
            }
        }

        if (($key = array_search($myname, $sharing)) !== false) {
            unset($sharing[$key]);
        }
        return $sharing;
    }
}
