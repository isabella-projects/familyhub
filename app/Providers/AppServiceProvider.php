<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
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
        View::composer('admin-dashboard', function ($view) {
            $user = auth()->user();
            $view->with('username', $user->username);
            $view->with('isAdmin', $user->isAdmin);
        });
    }
}
