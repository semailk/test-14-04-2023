<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (Genre::query()->get()->count() < 1) {
            $genres = [['title' => 'Криминальный'], ['title' => 'Фантастика'], ['title' => 'Приключения'], ['title' => 'Роман'], ['title' => 'Исторический']];
            Genre::query()->upsert($genres, 'title');
        }

        $authors = Author::factory()->count(20)->has(Book::factory(['genre_id' => rand(1, 5)])->count(3), 'books')->create();

        $authors->map(function (Author $author) {
            $author->books()->attach(Book::factory(['genre_id' => rand(1, 5)])->count(3)->create()->pluck('id'));
        });

        Book::query()->get()->map(function (Book $book) {
            $book->authors()->attach(rand(1, 20));
        });
    }
}
