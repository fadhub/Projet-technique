<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        // Gate pour autoriser la suppression des tâches
        // Fadna ne peut pas supprimer de tâches
        Gate::define('delete-task', function ($user) {
            return strtolower($user->email) !== 'fadna.lakhouchen@gmail.com'; 
        });
    }
}
