<?php
namespace App\Services;
use App\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;



class TaskService
{

    private const PER_PAGE = 10;

    public function getAll(array $filters = []): LengthAwarePaginator
    {
        $query = Task::query()->with(['user', 'categories']);

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

        // Pagination
        return $query->latest()->paginate(self::PER_PAGE);
    }

    public function create(array $data): Task
{
    if (!empty($data['image'])) {
        $data['image'] = $data['image']->store('tasks', 'public');
    }

    $task = Task::create($data);

    if (isset($data['categories'])) {
        $task->categories()->sync($data['categories']);
    }

    return $task->load(['user', 'categories']);
}


    public function update(int $id, array $data): Task
    {
        $task = Task::findOrFail($id);

        // Mettre à jour le chemin de l'image si besoin
        if (isset($data['image'])) {
            if ($task->image) {
                Storage::disk('public')->delete($task->image);
            }
            $task->image = $data['image']->store('tasks', 'public');
        }

        $task->update(collect($data)->except('image')->toArray());

        return $task->refresh();
    }

    public function delete(int $id): bool
    {
        $task = Task::findOrFail($id);
        if ($task->image) {
            Storage::disk('public')->delete($task->image);
        }
        return (bool) $task->delete();
    }
}
