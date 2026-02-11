<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TaskService;
use App\Models\Category;
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
        $categoryId = $request->query('category_id');
        $search = $request->query('search');
        $tasks = $this->taskService->index(2, $categoryId, $search);
        
        if ($request->ajax()) {
            return view('admin.tasks._table_container', compact('tasks'))->render();
        }

        $categories = Category::all();
        return view('admin.tasks.index', compact('tasks', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.tasks.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
        ]);

        $data['user_id'] = auth()->id() ?? \App\Models\User::first()->id; // Fallback to first user for demo/testing
        $task = $this->taskService->store($data);

        if (!empty($data['category_ids'])) {
            $task->categories()->sync($data['category_ids']);
        }

        return redirect()->route('admin.tasks.index')->with('success', 'Task created successfully.');
    }

    public function show($id)
    {
        $task = $this->taskService->show($id);
        return view('admin.tasks.show', compact('task'));
    }

    public function edit($id)
    {
        $task = $this->taskService->show($id);
        $categories = Category::all();
        $selectedCategories = $task->categories->pluck('id')->toArray();
        return view('admin.tasks.edit', compact('task', 'categories', 'selectedCategories'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
        ]);

        $task = $this->taskService->update($id, $data);

        if (isset($data['category_ids'])) {
            $task->categories()->sync($data['category_ids']);
        }

        return redirect()->route('admin.tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy($id)
    {
        \Illuminate\Support\Facades\Gate::authorize('delete-task');
        
        $this->taskService->delete($id);
        return redirect()->route('admin.tasks.index')->with('success', 'Task deleted successfully.');
    }
}
