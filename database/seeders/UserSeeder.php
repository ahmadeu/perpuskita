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
            'name' => 'Suliyati',
            'email' => 'admin@umku.ac.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'nim' => null // Admin tidak perlu NIM
        ]);

        User::create([
            'name' => 'Suswanto',
            'email' => 'admin2@umku.ac.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'nim' => null 
        ]);

        // Buat beberapa user mahasiswa dengan nama Indonesia
        $mahasiswa = [
            [
                'name' => 'Ahmad Rizki Pratama',
                'email' => 'mahasiswa1@umku.ac.id',
                'nim' => '2021001',
                'password' => Hash::make('mahasiswa123'),
                'role' => 'user'
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'mahasiswa2@umku.ac.id',
                'nim' => '2021002',
                'password' => Hash::make('mahasiswa123'),
                'role' => 'user'
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'mahasiswa3@umku.ac.id',
                'nim' => '2021003',
                'password' => Hash::make('mahasiswa123'),
                'role' => 'user'
            ],
            [
                'name' => 'Dewi Sartika',
                'email' => 'mahasiswa4@umku.ac.id',
                'nim' => '2021004',
                'password' => Hash::make('mahasiswa123'),
                'role' => 'user'
            ],
            [
                'name' => 'Eko Prasetyo',
                'email' => 'mahasiswa5@umku.ac.id',
                'nim' => '2021005',
                'password' => Hash::make('mahasiswa123'),
                'role' => 'user'
            ],
            [
                'name' => 'Fatimah Azzahra',
                'email' => 'mahasiswa6@umku.ac.id',
                'nim' => '2021006',
                'password' => Hash::make('mahasiswa123'),
                'role' => 'user'
            ],
            [
                'name' => 'Gunawan Setiawan',
                'email' => 'mahasiswa7@umku.ac.id',
                'nim' => '2021007',
                'password' => Hash::make('mahasiswa123'),
                'role' => 'user'
            ],
            [
                'name' => 'Hesti Wulandari',
                'email' => 'mahasiswa8@umku.ac.id',
                'nim' => '2021008',
                'password' => Hash::make('mahasiswa123'),
                'role' => 'user'
            ],
            [
                'name' => 'Indra Kusuma',
                'email' => 'mahasiswa9@umku.ac.id',
                'nim' => '2021009',
                'password' => Hash::make('mahasiswa123'),
                'role' => 'user'
            ],
            [
                'name' => 'Kartika Sari',
                'email' => 'mahasiswa10@umku.ac.id',
                'nim' => '2021010',
                'password' => Hash::make('mahasiswa123'),
                'role' => 'user'
            ]
        ];

        foreach ($mahasiswa as $data) {
            User::create($data);
        }

        // // Buat 20 user tambahan menggunakan factory
        // User::factory(20)->create([
        //     'role' => 'user',
        //     'nim' => function() {
        //         static $counter = 11;
        //         return '2021' . str_pad($counter++, 3, '0', STR_PAD_LEFT);
        //     }
        // ]);
    }
} 