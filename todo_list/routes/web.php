<?php


use App\Http\Controllers\PublicTaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TaskController as AdminTaskController;


Route::prefix('admin')->name('admin.')->group(function () {
	Route::get('/tasks', [AdminTaskController::class, 'index'])->name('tasks.index');
	Route::post('/tasks', [AdminTaskController::class, 'store'])->name('tasks.store');
	Route::get('/tasks/{id}', [AdminTaskController::class, 'show'])->name('tasks.show');
});

