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

        // Daftar email user dengan role medis
        $medisEmails = [
            'aidatunnazli28@gmail.com',
            'nadiraaaamelia@gmail.com',
            'nadzwaangeliaputri@gmail.com',
            'adahhytii@gmail.com',
            'rahardinadc@gmail.com',
            'rinamujiatiastuti@gmail.com',
            'sitikomariahpps112@gmail.com',
            'trianaagustin739@gmail.com',
            'yulitaniaizz567@gmail.com',
            'Kescasey66@gmail.com',
            'hastinatasasih87@gmail.com',
            'hastin.bkd@gmail.com',
        ];

        foreach ($medisEmails as $email) {
            $username = explode('@gmail.com', $email)[0];

            User::updateOrCreate(
                ['username' => $username],
                [
                    'name'     => $username,
                    'username' => $username,
                    'email'    => $email,
                    'role'     => 'medis',
                    'password' => Hash::make($username),
                ]
            );
        }
    }
}

