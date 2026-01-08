<?php
namespace App\Services;
use App\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;



class TaskService
{
    public function index(int $perPage = 10, ?int $categoryId = null, ?string $search = null): LengthAwarePaginator
    {
        $query = Task::query();

        if ($categoryId) {
            $query->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('categories.id', $categoryId);
            });
        }

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        return $query->with(['user', 'categories'])->paginate($perPage);
    }

    public function show(int $id): Task
    {
        return Task::with(['user', 'categories'])->findOrFail($id);
    }

    public function store(array $data): Task
    {

        // Upload image si elle existe
        if(!empty($data['image'])){
            $data['image'] = $data['image']->store('tasks', 'public');
        }


        return Task::create($data);
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
