<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $file = database_path('seeders/data/tasks.csv');
        $rows = array_map('str_getcsv', file($file));
        $header = array_shift($rows);

        foreach ($rows as $row) {
            $data = array_combine($header, $row);

            $task = Task::create([
                'title'        => $data['title'],
                'description'  => $data['description'] === 'null' ? null : $data['description'],
                'image'        => $data['image'] === 'null' ? null : $data['image'],
                'is_completed' => (bool) $data['is_completed'],
                'user_id'      => $data['user_id'],
                'created_at'   => $data['created_at'],
                'updated_at'   => $data['updated_at'],
            ]);

            // Relation many-to-many
            if (!empty($data['category_id'])) {
                $task->categories()->syncWithoutDetaching([$data['category_id']]);
            }
        }
    }
}
