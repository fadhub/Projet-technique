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
        //il faut ajouter manage dans spartie
        // Gate pour autoriser la suppression des tâches
        // Seul l'administrateur peut supprimer
        Gate::define('delete-task', function ($user) {
            return $user->role === 'admin';
        });
    }
}
