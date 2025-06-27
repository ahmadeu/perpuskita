<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Array nama Indonesia yang umum
        $indonesianNames = [
            'Ahmad Rizki', 'Siti Nurhaliza', 'Budi Santoso', 'Dewi Sartika', 'Eko Prasetyo',
            'Fatimah Azzahra', 'Gunawan Setiawan', 'Hesti Wulandari', 'Indra Kusuma', 'Joko Widodo',
            'Kartika Sari', 'Lukman Hakim', 'Maya Indah', 'Nugroho Pratama', 'Oktavia Putri',
            'Prabowo Subianto', 'Rina Marlina', 'Sugeng Riyadi', 'Tuti Handayani', 'Umar Said',
            'Vina Safitri', 'Wahyu Nugroho', 'Yuni Safitri', 'Zainal Abidin', 'Aisyah Putri',
            'Bambang Tri', 'Citra Dewi', 'Doni Kusuma', 'Eva Marlina', 'Fajar Ramadhan',
            'Gita Purnama', 'Hendra Gunawan', 'Ika Safitri', 'Jaya Kusuma', 'Kartika Dewi',
            'Lukman Nur', 'Mira Safitri', 'Nugraha Pratama', 'Oktaviana', 'Purnama Sari',
            'Rizki Pratama', 'Sari Indah', 'Teguh Santoso', 'Umi Kulsum', 'Viktor Pratama',
            'Wati Safitri', 'Yoga Pratama', 'Zahra Putri', 'Ahmad Fauzi', 'Beti Safitri',
            'Candra Kusuma', 'Dewi Sartika', 'Eko Yulianto', 'Fitri Handayani', 'Gunawan Jaya'
        ];

        return [
            'name' => fake()->randomElement($indonesianNames),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
