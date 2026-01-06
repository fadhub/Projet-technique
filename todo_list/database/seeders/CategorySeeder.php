<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(database_path('data/categories.csv'), 'r');
        
        // Skip header
        fgetcsv($file);

        while (($data = fgetcsv($file)) !== FALSE) {
            Category::create([
                'id' => $data[0],
                'name' => $data[1],
                'created_at' => $data[2],
                'updated_at' => $data[3],
            ]);
        }

        fclose($file);
    }
}
