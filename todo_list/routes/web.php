<?php


use App\Http\Controllers\PublicTaskController;
use Illuminate\Support\Facades\Route;

// Routes publiques
Route::controller(PublicTaskController::class)->group(function () {
    // Page d'accueil - Liste des tâches
    Route::get('/', 'index')->name('tasks.index');
    
    // Page de détail d'une tâche
    Route::get('/tasks/{id}', 'show')->name('tasks.show');

    // Route to handle form submission (fixes Route [tasks.store] not defined)
    Route::post('/tasks', 'store')->name('tasks.store');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('tasks', \App\Http\Controllers\Admin\TaskController::class);
});
