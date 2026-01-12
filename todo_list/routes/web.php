<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/tasks/search', [TaskController::class, 'search'])->name('tasks.search');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
