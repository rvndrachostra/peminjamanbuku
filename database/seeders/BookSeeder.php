<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Book;

class BookSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories for books
        $categories = [
            ['name' => 'Fiksi', 'description' => 'Novel, cerita pendek, dan karya imajinatif'],
            ['name' => 'Non-Fiksi', 'description' => 'Biografi, sejarah, dan karya faktual'],
            ['name' => 'Pendidikan', 'description' => 'Buku pelajaran dan referensi akademik'],
            ['name' => 'Teknologi', 'description' => 'Programming, IT, dan teknologi modern'],
            ['name' => 'Sains', 'description' => 'Fisika, kimia, biologi, dan ilmu pengetahuan'],
            ['name' => 'Seni', 'description' => 'Musik, lukis, fotografi, dan kreativitas'],
            ['name' => 'Motivasi', 'description' => 'Inspirasi, sukses, dan pengembangan diri'],
            ['name' => 'Bahasa', 'description' => 'Bahasa Inggris, Indonesia, dan linguistik'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create sample books
        $books = [
            [
                'category_id' => 1, // Fiksi
                'name' => 'Harry Potter and the Philosopher\'s Stone',
                'author' => 'J.K. Rowling',
                'isbn' => '978-0-7475-3269-9',
                'year_published' => 1997,
                'qty_total' => 5,
                'qty_available' => 5,
                'description' => 'Petualangan magis seorang anak penyihir di Hogwarts School of Witchcraft and Wizardry.'
            ],
            [
                'category_id' => 2, // Non-Fiksi
                'name' => 'Sapiens: A Brief History of Humankind',
                'author' => 'Yuval Noah Harari',
                'isbn' => '978-0-06-231609-7',
                'year_published' => 2011,
                'qty_total' => 3,
                'qty_available' => 3,
                'description' => 'Sejarah manusia dari zaman batu hingga era modern.'
            ],
            [
                'category_id' => 3, // Pendidikan
                'name' => 'Matematika SMA Kelas X',
                'author' => 'Tim Penyusun',
                'isbn' => '978-602-244-123-4',
                'year_published' => 2020,
                'qty_total' => 10,
                'qty_available' => 10,
                'description' => 'Buku matematika untuk siswa SMA kelas X sesuai kurikulum nasional.'
            ],
            [
                'category_id' => 4, // Teknologi
                'name' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
                'author' => 'Robert C. Martin',
                'isbn' => '978-0-13-235088-4',
                'year_published' => 2008,
                'qty_total' => 2,
                'qty_available' => 2,
                'description' => 'Panduan menulis kode yang bersih dan maintainable dalam pengembangan software.'
            ],
            [
                'category_id' => 5, // Sains
                'name' => 'A Brief History of Time',
                'author' => 'Stephen Hawking',
                'isbn' => '978-0-553-38016-9',
                'year_published' => 1988,
                'qty_total' => 4,
                'qty_available' => 4,
                'description' => 'Penjelasan tentang kosmologi dan teori relativitas untuk umum.'
            ],
            [
                'category_id' => 6, // Seni
                'name' => 'The Elements of Style',
                'author' => 'William Strunk Jr. and E.B. White',
                'isbn' => '978-0-205-30902-3',
                'year_published' => 1959,
                'qty_total' => 3,
                'qty_available' => 3,
                'description' => 'Panduan klasik untuk menulis bahasa Inggris yang efektif.'
            ],
            [
                'category_id' => 7, // Motivasi
                'name' => 'Atomic Habits',
                'author' => 'James Clear',
                'isbn' => '978-0-7352-1129-2',
                'year_published' => 2018,
                'qty_total' => 6,
                'qty_available' => 6,
                'description' => 'Panduan praktis untuk membangun kebiasaan baik dan menghilangkan kebiasaan buruk.'
            ],
            [
                'category_id' => 8, // Bahasa
                'name' => 'English Grammar in Use',
                'author' => 'Raymond Murphy',
                'isbn' => '978-0-521-18906-4',
                'year_published' => 1994,
                'qty_total' => 8,
                'qty_available' => 8,
                'description' => 'Buku referensi tata bahasa Inggris untuk semua level.'
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}