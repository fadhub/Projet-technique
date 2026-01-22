<?php
namespace App\Services;
use App\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;



class TaskService
{

    private const PER_PAGE = 10;

    public function getAll(array $filters = [], int $perPage = self::PER_PAGE): LengthAwarePaginator
    {
        $query = Task::query()->with(['categories']);

        //  Recherche (title + description)
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('description', 'like', '%' . $filters['search'] . '%');
            });
        }

        // Filtrer par catégorie
        if (!empty($filters['category_id'])) {
            $query->whereHas('categories', function ($q) use ($filters) {
                $q->where('categories.id', $filters['category_id']);
            });
        }

        // Filtrer par statut
        if (isset($filters['is_completed']) && $filters['is_completed'] !== '') {
            $query->where('is_completed', $filters['is_completed']);
        }

        // Pagination
        return $query->latest()->paginate($perPage);
    }

    public function show(int $id): Task
    {
        return Task::with(['categories'])->findOrFail($id);
    }

    public function create(array $data): Task
    {
        if (!empty($data['image'])) {
            $data['image'] = $data['image']->store('tasks', 'public');
        }

        $task = Task::create(collect($data)->except(['category_id', 'categories'])->toArray());

        if (isset($data['category_id'])) {
            $task->categories()->sync([$data['category_id']]);
        } elseif (isset($data['categories'])) {
            $task->categories()->sync($data['categories']);
        }

        return $task->load(['categories']);
    }

    public function update(int $id, array $data): Task
    {
        $task = Task::findOrFail($id);

        if (isset($data['image'])) {
            if ($task->image) {
                Storage::disk('public')->delete($task->image);
            }
            $task->image = $data['image']->store('tasks', 'public');
        }

        $task->update(collect($data)->except(['image', 'category_id', 'categories'])->toArray());

        if (isset($data['category_id'])) {
            $task->categories()->sync([$data['category_id']]);
        } elseif (isset($data['categories'])) {
            $task->categories()->sync($data['categories']);
        }

        return $task->load(['categories']);
    }

    public function delete(int $id): bool
    {
        $task = Task::findOrFail($id);
        if ($task->image) {
            Storage::disk('public')->delete($task->image);
        }
        return (bool) $task->delete();
    }

    public function toggleStatus(int $id): Task
    {
        $task = Task::findOrFail($id);
        $task->is_completed = !$task->is_completed;
        $task->save();
        return $task;
    }
}
