<?php

namespace App\Http\Resources\Book;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $title
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property int $age
 * @property int $id
 * @property int $genre_id
 *
 * @package App\Http\Resources\Book
 * @mixin Book
 *
 * @OA\Schema (
 *     title="Book resource",
 *     description="Book resource",
 *     @OA\Xml(
 *         name="Book resource"
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
class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'genre_id' => $this->genre_id,
            'title' => $this->title,
            'description' => $this->description,
            'age' => $this->age,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'genre_title' => $this->genre->title,
            'authors' => $this->authors
        ];
    }
}
