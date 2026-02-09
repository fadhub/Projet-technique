<?php


use App\Http\Controllers\PublicTaskController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


// Routes publiques
Route::controller(PublicTaskController::class)->group(function () {
    // Page d'accueil - Liste des tâches
    Route::get('/', 'index')->name('tasks.index');
    
    // Page de détail d'une tâche
    Route::get('/tasks/{id}', 'show')->name('tasks.show');
});

