<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use App\Models\Category;
use App\Services\TaskService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TaskServiceTest extends TestCase
{
    use DatabaseTransactions;

    protected TaskService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new TaskService();
    }

    /** @test */
    public function it_can_get_all_tasks()
    {
        $result = $this->service->getAll();

        $this->assertGreaterThan(0, $result->total());
    }

    /** @test */
    public function it_can_filter_tasks_by_search()
    {
        $task = Task::first();
        $this->assertNotNull($task);

        $keyword = $task->description ?: $task->title;

        $result = $this->service->getAll([
        'search' => $keyword
    ]);
        $this->assertGreaterThanOrEqual(1, $result->total());
    }

    /** @test */
    public function test_it_can_filter_tasks_by_category()
{
    $category = \App\Models\Category::first();

    $this->assertNotNull($category);

    $result = $this->service->getAll([
        'category_id' => $category->id
    ]);

    $this->assertGreaterThan(0, $result->total());
}


    /** @test */
    public function it_can_update_a_task()
    {
        $task = Task::first();

        $this->service->update($task->id, [
            'title' => 'Updated Task Title'
        ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Updated Task Title'
        ]);
    }

    /** @test */
    public function it_can_delete_a_task()
    {
        $task = Task::first();

        $this->service->delete($task->id);

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id
        ]);
    }
}
