<?php

namespace App\Http\Resources\Author;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

/**
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
 *         property="first_name",
 *         format="string",
 *         description="Имя автора"
 *     ),
 *     @OA\Property(
 *         property="last_name",
 *         format="string",
 *         description="Фамилия автора"
 *     ),
 *     @OA\Property(
 *         property="surname",
 *         format="string",
 *         description="Отчество автора"
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
 * )
 */
class AuthorCollection extends ResourceCollection
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
