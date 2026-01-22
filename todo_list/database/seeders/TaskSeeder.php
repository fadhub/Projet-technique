<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $file = database_path('seeders/data/tasks.csv');
        $rows = array_map('str_getcsv', file($file));
        $header = array_shift($rows);

        foreach ($rows as $row) {
            if (count($header) !== count($row)) {
                continue;
            }

            $data = array_combine($header, $row);

            $task = Task::create([
                'title'        => $data['title'],
                'description'  => $data['description'] === 'null' ? null : $data['description'],
                'image'        => $data['image'] === 'null' ? null : $data['image'],
                'is_completed' => (bool) $data['is_completed'],
                'created_at'   => $data['created_at'],
                'updated_at'   => $data['updated_at'],
            ]);

            /** ===============================
             *  Gestion des catégories (N:N)
             *  =============================== */
            if (!empty($data['categories'])) {
                // Split by common separators: , ; | : -
                $categoryNames = preg_split('/\s*[,;|:\-]\s*/', $data['categories']);
                
                foreach ($categoryNames as $name) {
                    $category = \App\Models\Category::firstOrCreate(['name' => $name]);
                    $task->categories()->attach($category->id);
                }
            }
        }
    }
}
