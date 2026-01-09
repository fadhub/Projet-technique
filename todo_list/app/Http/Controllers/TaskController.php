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
        $this->middleware('auth');
        $this->taskService = $taskService;
    }

    public function index()
    {
        $tasks = Task::latest()->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_completed' => 'boolean',
            'category_id' => 'required|exists:categories,id'
        ]);

        $data['user_id'] = auth()->id();
        
        $this->taskService->store($data);

        return redirect()->route('tasks.index')
            ->with('success', 'Tâche créée avec succès');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_completed' => 'boolean',
            'category_id' => 'required|exists:categories,id'
        ]);

        $this->taskService->update($task->id, $data);

        return redirect()->route('tasks.show', $task->id)
            ->with('success', 'Tâche mise à jour avec succès');
    }

    public function destroy(Task $task)
    {
        $this->taskService->delete($task->id);
        return redirect()->route('tasks.index')
            ->with('success', 'Tâche supprimée avec succès');
    }
}