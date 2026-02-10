<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer un utilisateur admin par défaut
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrateur',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ]
        );

        $this->command->info('Utilisateur admin créé avec succès!');
        $this->command->info('Email: admin@example.com');
        $this->command->info('Mot de passe: password');
    }
}
