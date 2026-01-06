<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(database_path('data/tasks.csv'), 'r');
        
        // Skip header
        fgetcsv($file);

        while (($data = fgetcsv($file)) !== FALSE) {
            Task::create([
                'id' => $data[0],
                'title' => $data[1],
                'description' => $data[2] === 'null' ? null : $data[2],
                'image' => $data[3] === 'null' ? null : $data[3],
                'is_completed' => (bool) $data[4],
                'user_id' => $data[5],
                'created_at' => $data[6],
                'updated_at' => $data[7],
            ]);
        }

        fclose($file);
    }
}
