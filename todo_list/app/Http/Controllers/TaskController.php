<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $tasks = $this->taskService->index();
        return view('tasks.index', compact('tasks'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $tasks = $this->taskService->index(10, null, $search); // Assuming null category for now
        
        // Return HTML table rows or JSON? 
        // User asked for "recherche avec ajax", usually returning HTML partial or JSON to render.
        // Given "basic JS" instruction, returning JSON and building DOM in JS might be cleaner for "vanilla JS",
        // OR returning partial HTML. Let's return JSON for "modal vanila et recherche avec ajax".
        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_completed' => 'required|boolean',
        ]);

        // Assign a default user if not authenticated (for demo purposes)
        $data['user_id'] = auth()->id() ?? 1;

        $task = $this->taskService->store($data);

        return response()->json($task);
    }
}
