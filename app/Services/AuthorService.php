<?php

namespace App\Services;

use App\DTO\AuthorDTO;
use App\Models\Author;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AuthorService
{
    /**
     * @return LengthAwarePaginator
     */
    public function getList(): LengthAwarePaginator
    {
        return Author::query()->paginate();
    }

    /**
     * @param AuthorDTO $authorDTO
     * @return Author
     */
    public function create(AuthorDTO $authorDTO): Author
    {
        /** @var Author */
        return Author::query()->create($authorDTO->except('id')->toArray());
    }

    /**
     * @param Author $author
     * @param AuthorDTO $authorDTO
     * @return Author
     */
    public function update(Author $author, AuthorDTO $authorDTO): Author
    {
        $author->update($authorDTO->except('id')->toArray());

        return $author;
    }

    /**
     * @param Author $author
     * @return bool
     */
    public function delete(Author $author): bool
    {
        return $author->delete();
    }
}
