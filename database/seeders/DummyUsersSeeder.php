<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
                [
                    'name' => 'John Doe',
                    'email' => 'RyD0w@example.com',
                    'role' => 'admin',
                    'password' => bcrypt('12345678')
                ],
                [
                    'name' => 'John Doe',
                    'email' => 'RyD0w@example.com',
                    'role' => 'user',
                    'password' => bcrypt('12345678')
                ],
        ];
        foreach ($userData as $user) {
            User::create($user);
        }
    }
}
