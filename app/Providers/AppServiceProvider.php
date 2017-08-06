<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use View;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('pages.projects.home', function ($view){
            $view->with('projectsTrashed', Auth::user()->projects()->onlyTrashed()->get());
            $view->with('projects', Auth::user()->projects()->orderby('created_at')->get());
        });

        view()->composer('pages.projects.trashed', function ($view){
            $view->with('projectsTrashed', Auth::user()->projects()->onlyTrashed()->get());
            $view->with('projects', Auth::user()->projects()->orderby('created_at')->get());
        });

        view()->composer('pages.projects.show', function ($view){
            $view->with('projectsTrashed', Auth::user()->projects()->onlyTrashed()->get());
            $view->with('tasksTrashed', Auth::user()->tasks()->onlyTrashed()->get());
            $view->with('projects', Auth::user()->projects()->orderby('created_at')->get());
        });

        view()->composer('pages.projects.tasks.trashed', function ($view){
            $view->with('tasksTrashed', Auth::user()->tasks()->onlyTrashed()->get());
            $view->with('projects', Auth::user()->projects()->orderby('created_at')->get());
        });

        view()->composer('*', function ($view){
            $view->with('user', Auth::user());
            $view->with('currenttime', Carbon::now()->format('h:i a'));
            $view->with('today',  Carbon::now()->formatlocalized('%a %d %b %y'));
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
