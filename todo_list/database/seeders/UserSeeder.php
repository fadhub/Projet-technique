<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $file = database_path('seeders/data/users.csv');
        $rows = array_map('str_getcsv', file($file));
        $header = array_shift($rows);

        foreach ($rows as $row) {
            $data = array_combine($header, $row);

            User::firstOrCreate(
                ['email' => $data['email']],  
                [
                    'name' => $data['name'],
                    'role' => $data['role'] ?? 'user',
                    'password' => $data['password'], // Assuming CSV has the hash
                ]
            );
        }
    }
}
