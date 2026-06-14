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
        // Admin
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name'     => 'Administrator',
                'username' => 'admin',
                'email'    => 'admin@srmb.id',
                'role'     => 'admin',
                'password' => Hash::make('admin'),
            ]
        );
        // Medis
        User::updateOrCreate(
            ['username' => 'medis'],
            [
                'name'     => 'Tenaga Medis',
                'username' => 'medis',
                'email'    => 'medis@srmb.id',
                'role'     => 'medis',
                'password' => Hash::make('medis'),
            ]
        );
        // Medis
        User::updateOrCreate(
            ['username' => 'hastin'],
            [
                'name'     => 'Hastin',
                'username' => 'hastin',
                'email'    => 'hastin@srmb.id',
                'role'     => 'medis',
                'password' => Hash::make('hastin'),
            ]
        );
    }
}
