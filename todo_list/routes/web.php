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

// Routes d'administration
Route::get('/admin/tasks', [TaskController::class, 'index'])->name('admin.tasks.index');
Route::get('/admin/tasks/create', [TaskController::class, 'create'])->name('admin.tasks.create');
Route::post('/admin/tasks', [TaskController::class, 'store'])->name('admin.tasks.store');
Route::get('/admin/tasks/{task}/edit', [TaskController::class, 'edit'])->name('admin.tasks.edit');
Route::put('/admin/tasks/{task}', [TaskController::class, 'update'])->name('admin.tasks.update');
Route::delete('/admin/tasks/{task}', [TaskController::class, 'destroy'])->name('admin.tasks.destroy');
Route::get('/admin/tasks/{task}', [TaskController::class, 'show'])->name('admin.tasks.show');
Route::patch('/admin/tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('admin.tasks.toggle');

// Redirection de /admin vers la liste des tâches
Route::redirect('/admin', '/admin/tasks');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
