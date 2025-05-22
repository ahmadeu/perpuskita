<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Teknologi',
                'code' => 'TECH',
                'description' => 'Buku-buku tentang teknologi, komputer, dan informatika'
            ],
            [
                'name' => 'Pendidikan',
                'code' => 'EDU',
                'description' => 'Buku-buku pendidikan dan pembelajaran'
            ],
            [
                'name' => 'Novel',
                'code' => 'NOV',
                'description' => 'Kumpulan novel fiksi dan non-fiksi'
            ],
            [
                'name' => 'Sains',
                'code' => 'SCI',
                'description' => 'Buku-buku tentang sains dan penelitian'
            ],
            [
                'name' => 'Sejarah',
                'code' => 'HIS',
                'description' => 'Buku-buku sejarah dan budaya'
            ],
            [
                'name' => 'Agama',
                'code' => 'REL',
                'description' => 'Buku-buku keagamaan dan spiritual'
            ],
            [
                'name' => 'Bisnis',
                'code' => 'BUS',
                'description' => 'Buku-buku tentang bisnis dan ekonomi'
            ],
            [
                'name' => 'Kesehatan',
                'code' => 'HEALTH',
                'description' => 'Buku-buku tentang kesehatan dan kedokteran'
            ],
            [
                'name' => 'Seni & Desain',
                'code' => 'ART',
                'description' => 'Buku-buku tentang seni, desain, dan kreativitas'
            ],
            [
                'name' => 'Bahasa',
                'code' => 'LANG',
                'description' => 'Buku-buku tentang bahasa dan linguistik'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
} 