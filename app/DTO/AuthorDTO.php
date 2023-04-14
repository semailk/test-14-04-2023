<?php

namespace App\DTO;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

/**
 * @property string $first_name
 * @property string $last_name
 * @property string $surname
 * @property int|Optional $id
 */
class AuthorDTO extends Data
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $surname,
        public int|Optional $id
    )
    {
    }
}
