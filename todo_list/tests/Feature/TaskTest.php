<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    // Tutoriel 6.1.U3 : Transactions et État Initial (Rollback)
    // The RefreshDatabase trait ensures that the database is reset after each test
    // by running tests within a database transaction.
    use RefreshDatabase;

    public function test_a_task_can_be_created_using_factory_in_isolated_environment()
    {
        // Assert the database is initially empty for Tasks
        $this->assertDatabaseCount('tasks', 0);

        // Create a task using the TaskFactory
        $task = Task::factory()->create([
            'title' => 'Factory Task Title',
        ]);

        // Assert the task was created in the database
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Factory Task Title',
        ]);

        $this->assertDatabaseCount('tasks', 1);
        $this->assertDatabaseCount('users', 1); // User is created automatically by the factory
    }

    public function test_database_is_rolled_back_after_each_test()
    {
        // Because of RefreshDatabase, the task created in the previous test
        // should no longer exist here. The database state is rolled back.
        
        // Assert the database is empty again, proving the transaction was rolled back
        $this->assertDatabaseCount('tasks', 0);
        $this->assertDatabaseCount('users', 0);
    }
}
