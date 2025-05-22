<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user admin
        User::create([
            'name' => 'Admin Perpustakaan',
            'email' => 'admin@umku.ac.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'nim' => null // Admin tidak perlu NIM
        ]);

        // Buat beberapa user mahasiswa
        $mahasiswa = [
            [
                'name' => 'Mahasiswa 1',
                'email' => 'mahasiswa1@umku.ac.id',
                'nim' => '2021001',
                'password' => Hash::make('mahasiswa123'),
                'role' => 'user'
            ],
            [
                'name' => 'Mahasiswa 2',
                'email' => 'mahasiswa2@umku.ac.id',
                'nim' => '2021002',
                'password' => Hash::make('mahasiswa123'),
                'role' => 'user'
            ],
            [
                'name' => 'Mahasiswa 3',
                'email' => 'mahasiswa3@umku.ac.id',
                'nim' => '2021003',
                'password' => Hash::make('mahasiswa123'),
                'role' => 'user'
            ]
        ];

        foreach ($mahasiswa as $data) {
            User::create($data);
        }
    }
} 