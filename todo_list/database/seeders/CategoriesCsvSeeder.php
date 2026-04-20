<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieCsvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $csvFile = database_path('data/categories.csv');
    
    if (!file_exists($csvFile)) {
        $this->command->error("Le fichier CSV des catégories n'existe pas !");
        return;
    }

    $file = fopen($csvFile, 'r');
    $header = fgetcsv($file); // Lire l'en-tête

    while (($row = fgetcsv($file)) !== false) {
        \DB::table('categories')->insert([
            'id' => $row[0],
            'name' => $row[1],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    fclose($file);
}
}
