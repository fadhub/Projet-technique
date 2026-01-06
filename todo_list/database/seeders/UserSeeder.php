<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(database_path('data/users.csv'), 'r');
        
        // Skip header
        fgetcsv($file);

        while (($data = fgetcsv($file)) !== FALSE) {
            User::create([
                'id' => $data[0],
                'name' => $data[1],
                'email' => $data[2],
                'password' => $data[3],
                'created_at' => $data[4],
                'updated_at' => $data[5],
            ]);
        }

        fclose($file);
    }
}
