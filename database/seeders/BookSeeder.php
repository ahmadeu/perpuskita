<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            // Teknologi
            [
                'title' => 'Pemrograman Web dengan Laravel',
                'author' => 'John Doe',
                'isbn' => '978-1234567890',
                'publisher' => 'Tech Publisher',
                'publish_year' => 2023,
                'quantity' => 5,
                'description' => 'Buku panduan lengkap belajar Laravel untuk pemula hingga mahir',
                'category_id' => 1, // Teknologi
                'cover_image' => null,
                'status' => 'available'
            ],
            [
                'title' => 'Machine Learning untuk Pemula',
                'author' => 'Jane Smith',
                'isbn' => '978-0987654321',
                'publisher' => 'AI Books',
                'publish_year' => 2023,
                'quantity' => 3,
                'description' => 'Pengenalan machine learning dan implementasinya',
                'category_id' => 1, // Teknologi
                'cover_image' => null,
                'status' => 'available'
            ],

            // Pendidikan
            [
                'title' => 'Metode Pembelajaran Modern',
                'author' => 'Dr. Ahmad',
                'isbn' => '978-1122334455',
                'publisher' => 'Edu Press',
                'publish_year' => 2022,
                'quantity' => 4,
                'description' => 'Panduan metode pembelajaran terkini untuk pendidik',
                'category_id' => 2, // Pendidikan
                'cover_image' => null,
                'status' => 'available'
            ],

            // Novel
            [
                'title' => 'Petualangan di Pulau Misterius',
                'author' => 'Budi Santoso',
                'isbn' => '978-5544332211',
                'publisher' => 'Novel House',
                'publish_year' => 2023,
                'quantity' => 6,
                'description' => 'Novel petualangan seru untuk remaja',
                'category_id' => 3, // Novel
                'cover_image' => null,
                'status' => 'available'
            ],

            // Sains
            [
                'title' => 'Fisika Modern',
                'author' => 'Prof. Dr. Siti',
                'isbn' => '978-6677889900',
                'publisher' => 'Science Press',
                'publish_year' => 2022,
                'quantity' => 3,
                'description' => 'Pembahasan mendalam tentang fisika modern',
                'category_id' => 4, // Sains
                'cover_image' => null,
                'status' => 'available'
            ],

            // Sejarah
            [
                'title' => 'Sejarah Indonesia Modern',
                'author' => 'Dr. Rudi',
                'isbn' => '978-7788990011',
                'publisher' => 'History Books',
                'publish_year' => 2021,
                'quantity' => 4,
                'description' => 'Sejarah Indonesia dari masa kemerdekaan hingga sekarang',
                'category_id' => 5, // Sejarah
                'cover_image' => null,
                'status' => 'available'
            ],

            // Agama
            [
                'title' => 'Panduan Ibadah',
                'author' => 'Ustadz Ali',
                'isbn' => '978-8899001122',
                'publisher' => 'Religious Press',
                'publish_year' => 2023,
                'quantity' => 7,
                'description' => 'Panduan lengkap ibadah sehari-hari',
                'category_id' => 6, // Agama
                'cover_image' => null,
                'status' => 'available'
            ],

            // Bisnis
            [
                'title' => 'Manajemen Bisnis Digital',
                'author' => 'Sarah Wijaya',
                'isbn' => '978-9900112233',
                'publisher' => 'Business Books',
                'publish_year' => 2023,
                'quantity' => 5,
                'description' => 'Strategi mengelola bisnis di era digital',
                'category_id' => 7, // Bisnis
                'cover_image' => null,
                'status' => 'available'
            ],

            // Kesehatan
            [
                'title' => 'Gaya Hidup Sehat',
                'author' => 'Dr. Maya',
                'isbn' => '978-0011223344',
                'publisher' => 'Health Press',
                'publish_year' => 2022,
                'quantity' => 4,
                'description' => 'Panduan menjalani gaya hidup sehat',
                'category_id' => 8, // Kesehatan
                'cover_image' => null,
                'status' => 'available'
            ],

            // Seni & Desain
            [
                'title' => 'Dasar-dasar Desain Grafis',
                'author' => 'Andi Creative',
                'isbn' => '978-1122334455',
                'publisher' => 'Art Books',
                'publish_year' => 2023,
                'quantity' => 3,
                'description' => 'Panduan belajar desain grafis untuk pemula',
                'category_id' => 9, // Seni & Desain
                'cover_image' => null,
                'status' => 'available'
            ]
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
} 