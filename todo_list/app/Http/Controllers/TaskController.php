<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\Category;

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
        $categories = Category::all();
        return view('tasks.index', compact('tasks', 'categories'));
    }



    public function search(Request $request)
    {
        $search = $request->input('search');
        $tasks = Task::when($search, function($query) use ($search) {
            return $query->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
        })->get();

        return view('tasks._table_body', compact('tasks'));
    }
    

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_completed' => 'nullable|boolean',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data['is_completed'] = $request->has('is_completed');

        // Assign a default user (since no auth) return first user or 1
        $data['user_id'] = User::first()->id ?? 1;

        try {
            $task = $this->taskService->store($data);
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => __('messages.task_added'),
                    'task' => $task->load('user', 'categories')
                ]);
            }

            return redirect()->route('tasks.index')
                            ->with('success', __('messages.task_added'));
                            
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 422);
            }

            return back()->withInput()
                         ->with('error', $e->getMessage());
        }
    }
}
