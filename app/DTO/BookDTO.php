<?php

namespace App\DTO;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

/**
 * @property int $genre_id
 * @property array $authors_ids
 * @property int $age
 * @property int|Optional $id
 * @property string $description
 * @property string $title
 */
class BookDTO extends Data
{
    public function __construct(
        public string $title,
        public int $genre_id,
        public array $authors_ids,
        public string $description,
        public int $age,
        public int|Optional $id
    )
    {
    }
}
