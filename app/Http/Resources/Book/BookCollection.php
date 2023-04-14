<?php

namespace App\Http\Resources\Book;

use App\Models\Book;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

/**
 * @package App\Http\Resources\Book
 * @mixin Book
 *
 * @OA\Schema (
 *     title="Book collection",
 *     description="Book collection",
 *     @OA\Xml(
 *         name="Book collection"
 *     ),
 *     @OA\Property(
 *         property="id",
 *         format="integer",
 *         description="ID книги"
 *     ),
 *     @OA\Property(
 *         property="genre_id",
 *         format="integer",
 *         description="ID жанра книги"
 *     ),
 *     @OA\Property(
 *         property="title",
 *         format="string",
 *         description="Название книги"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         format="string",
 *         description="Описание книги"
 *     ),
 *     @OA\Property(
 *         property="age",
 *         format="integer",
 *         description="Год выпуска книги"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         format="string",
 *         description="Дата публикации книги"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         format="string",
 *         description="Дата обновления книги"
 *     ),
 *     @OA\Property(
 *         property="genre_title",
 *         format="string",
 *         description="Название жанра книги"
 *     ),
 *     @OA\Property(
 *         property="authors",
 *         format="array",
 *         description="Авторы книги"
 *     ),
 * )
 */
class BookCollection extends ResourceCollection
{
    /**
     * @param Request $request
     * @return array|JsonSerializable|Arrayable
     */
    public function toArray(Request $request): array|JsonSerializable|Arrayable
    {
        return $this->resource;
    }
}
