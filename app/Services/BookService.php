<?php

namespace App\Services;

use App\DTO\BookDTO;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class BookService
{
    /**
     * @param string $whereType
     * @param array $where
     * @return Collection
     */
    public function getList(string $whereType = '', array $where = []): Collection
    {
        $builder = $this->getBuilder()->with('genre');

        if ($whereType == 'age') {
            $builder->whereBetween('age', $where);
        } elseif ($whereType == 'genre') {
            if (count($where) > 0) {
                $builder->whereHas('genre', function ($query) use ($where) {
                    return $query->whereIn('title', $where);
                });
            }
        }

        return $builder->get();
    }

    /**
     * @return Builder
     */
    protected function getBuilder(): Builder
    {
        return Book::query();
    }

    /**
     * @param Author $author
     * @return Collection
     */
    public function getListBooksByAuthor(Author $author): Collection
    {
        return $author->books()->get();
    }

    /**
     * @param BookDTO $bookDTO
     * @return Book
     */
    public function create(BookDTO $bookDTO): Book
    {
        $newBook = Book::query()->create($bookDTO->toArray());
        /** @var Book $newBook */
        foreach ($bookDTO->authors_ids as $author_id) {
            $newBook->authors()->attach($author_id);
        }


        return $newBook->load(['authors']);
    }

    /**
     * @param Book $book
     * @param BookDTO $bookDTO
     * @return Book
     */
    public function update(Book $book, BookDTO $bookDTO): Book
    {
        $book->update($bookDTO->toArray());
        $book->authors()->sync($bookDTO->authors_ids);

        return $book;
    }
}
