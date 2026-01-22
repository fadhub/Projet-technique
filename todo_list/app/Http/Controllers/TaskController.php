<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['search', 'category_id', 'is_completed']);
        $tasks = $this->taskService->getAll($filters, 10);
        $categories = \App\Models\Category::all();

        if ($request->ajax()) {
            return view('admin.tasks._table', compact('tasks'))->render();
        }

        return view('admin.tasks.index', compact('tasks', 'categories'));
    }

    public function create()
    {
        return view('admin.tasks.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_completed' => 'boolean',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id'
        ]);

        $data['is_completed'] = $request->has('is_completed');
        $data['categories'] = $request->category_ids; // TaskService gère déjà 'categories'

        $this->taskService->create($data);

        return redirect()->route('admin.tasks.index')
            ->with('success', 'Tâche créée avec succès');
    }

    public function show(Task $task)
    {
        return view('admin.tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('admin.tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_completed' => 'boolean',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id'
        ]);

        $data['is_completed'] = $request->has('is_completed');
        $data['categories'] = $request->category_ids;

        $this->taskService->update($task->id, $data);

        return redirect()->route('admin.tasks.index')
            ->with('success', 'Tâche mise à jour avec succès');
    }

    public function destroy(Task $task)
    {
        $this->taskService->delete($task->id);
        return redirect()->route('admin.tasks.index')
            ->with('success', 'Tâche supprimée avec succès');
    }

    public function toggle(Task $task)
    {
        $this->taskService->toggleStatus($task->id);
        return redirect()->back()->with('success', 'Statut de la tâche mis à jour.');
    }
}