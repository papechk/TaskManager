<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Supprimer les utilisateurs existants
        User::where('email', 'admin@example.com')->delete();
        User::where('email', 'manager@example.com')->delete();
        User::where('email', 'user@example.com')->delete();

        $teAdmin = User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        $teManager = User::create([
            'name' => 'manager',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
        ]);

        $teUser = User::create([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
        ]);

        $teAdmin->roles()->attach([1, 2]);
        $teManager->roles()->attach([2]);
        $teUser->roles()->attach([3]);
    }
}