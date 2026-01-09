<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\TaskService;
use App\Models\Task;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class TaskServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $category;
    protected $service;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Créer un utilisateur de test
        $this->user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
        
        // Créer une catégorie de test
        $this->category = Category::create(['name' => 'Test Category']);
        
        $this->service = new TaskService();
        $this->actingAs($this->user);
    }

    public function test_it_can_store_a_task()
    {
        Storage::fake('public');
        
        $data = [
            'title' => 'Nouvelle Tâche',
            'description' => 'Description de test',
            'user_id' => $this->user->id,
            'image' => UploadedFile::fake()->image('task.jpg')
        ];

        $task = $this->service->store($data);

        $this->assertInstanceOf(Task::class, $task);
        $this->assertDatabaseHas('tasks', [
            'title' => 'Nouvelle Tâche',
            'description' => 'Description de test',
            'user_id' => $this->user->id
        ]);
        
        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('public');
        $disk->assertExists($task->image);
    }

    public function test_it_can_show_a_task()
    {
        $task = Task::create([
            'title' => 'Test Task',
            'description' => 'Test Description',
            'user_id' => $this->user->id
        ]);

        $result = $this->service->show($task->id);

        $this->assertEquals($task->id, $result->id);
        $this->assertArrayHasKey('user', $result->toArray());
        $this->assertArrayHasKey('categories', $result->toArray());
    }

    public function test_it_returns_paginated_tasks()
{
    // Créer des tâches directement
    for ($i = 0; $i < 15; $i++) {
        $task = Task::create([
            'title' => "Task {$i}",
            'description' => "Description {$i}",
            'user_id' => $this->user->id
        ]);
        
        // Ajouter une catégorie à la première tâche
        if ($i === 0) {
            $task->categories()->attach($this->category->id);
            $firstTask = $task;
        }
    }

    // Tester sans filtre
    $result = $this->service->index(10);
    $this->assertCount(10, $result->items());
    $this->assertEquals(15, $result->total());

    // Tester avec filtre de catégorie
    $result = $this->service->index(10, $this->category->id);
    $this->assertGreaterThanOrEqual(1, $result->count());

    // Tester avec recherche
    $result = $this->service->index(10, null, $firstTask->title);
    $this->assertGreaterThanOrEqual(1, $result->count());
}

    public function test_it_can_update_a_task()
    {
        Storage::fake('public');
        
        $task = Task::create([
            'title' => 'Ancien titre',
            'description' => 'Ancienne description',
            'user_id' => $this->user->id,
            'image' => 'old/path.jpg'
        ]);

        $data = [
            'title' => 'Nouveau titre',
            'description' => 'Nouvelle description',
            'image' => UploadedFile::fake()->image('new.jpg')
        ];

        $updatedTask = $this->service->update($task->id, $data);

        $this->assertEquals('Nouveau titre', $updatedTask->title);
        $this->assertEquals('Nouvelle description', $updatedTask->description);
        
        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('public');
        $disk->assertExists($updatedTask->image);
    }

    public function test_it_can_delete_a_task()
    {
        Storage::fake('public');
        
        $task = Task::create([
            'title' => 'Tâche à supprimer',
            'description' => 'Description',
            'user_id' => $this->user->id,
            'image' => 'tasks/test.jpg'
        ]);
        
        Storage::disk('public')->put($task->image, 'dummy content');

        $result = $this->service->delete($task->id);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
        
        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('public');
        $disk->assertMissing($task->image);
    }

    public function test_it_can_handle_missing_task()
    {
        $this->expectException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);
        $this->service->show(999);
    }
}