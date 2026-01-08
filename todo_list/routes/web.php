<?php

use App\Models\Category;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request, TaskService $taskService) {
    if ($request->isMethod('post')) {
        return redirect()->route('tasks.store');
    }
    $categoryId = $request->get('category_id');
    $tasks = $taskService->index(9, $categoryId);
    $categories = Category::all();

    return view('tasks.index', compact('tasks', 'categories', 'categoryId'));
})->name('tasks.index');

Route::get('/tasks/{id}', function ($id, TaskService $taskService) {
    $task = $taskService->show($id);
    return view('tasks.show', compact('task'));
})->name('tasks.show');

Route::post('/tasks', function (Request $request, TaskService $taskService) {
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'category_id' => 'required|exists:categories,id',
    ]);

    $task = $taskService->store([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'user_id' => 1, // Default user
    ]);

    $task->categories()->attach($validated['category_id']);

    return redirect()->route('tasks.index')->with('success', 'Tâche ajoutée avec succès !');
})->name('tasks.store');
