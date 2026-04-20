<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TaskService;

class TaskController extends Controller
{
    public function __construct(private TaskService $taskService) {}

    public function index(Request $request)
    {
        $search = $request->get('search');

        $tasks = $this->taskService->index(
            perPage: 10,
            categoryId: null,
            search: $search
        );

        if ($request->ajax()) {
            return view('admin.tasks.partials.table', compact('tasks'))->render();
        }

        return view('admin.tasks.index', compact('tasks'));
    }

    public function show(int $id)
    {
        $task = $this->taskService->show($id);

        return response()->json($task);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $task = $this->taskService->store($request->only('title', 'description', 'user_id'));

        return response()->json(['success' => true, 'task' => $task]);
    }
}
