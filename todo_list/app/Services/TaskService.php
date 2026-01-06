<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskService
{
    /**
     * Get paginated tasks.
     */
    public function index(int $perPage = 10): LengthAwarePaginator
    {
        return Task::paginate($perPage);
    }

    /**
     * Get a specific task by ID.
     */
    public function show(int $id): Task
    {
        return Task::findOrFail($id);
    }

    /**
     * Create a new task.
     */
    public function store(array $data): Task
    {
        return Task::create($data);
    }

    /**
     * Update an existing task.
     */
    public function update(int $id, array $data): Task
    {
        $task = Task::findOrFail($id);
        $task->update($data);

        return $task->refresh();
    }

    /**
     * Delete a task.
     */
    public function delete(int $id): bool
    {
        $task = Task::findOrFail($id);
        return (bool) $task->delete();
    }
}
