<?php

namespace App\Http\Controllers;

use App\DTO\AuthorDTO;
use App\Http\Requests\AuthorRequest;
use App\Http\Resources\Author\AuthorCollection;
use App\Http\Resources\Author\AuthorResource;
use App\Models\Author;
use App\Services\AuthorService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends Controller
{
    public function __construct(private readonly AuthorService $authorService)
    {
    }

    /**
     * @return JsonResponse
     * @OA\Get  (
     *  path="/api/authors",
     *  summary="Get authors",
     *  description="Get authors",
     *     tags={"Author"},
     *     @OA\Response(
     *     response=200,
     *     description="Get books",
     *         @OA\JsonContent (
     *         type="array",
     *             @OA\Items (
     *                 ref="#/components/schemas/AuthorCollection"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *     response=404,
     *     description="Not found",
     *     ),
     *     @OA\Response(
     *     response=500,
     *     description="Server error",
     *     ),
     * ),
     */
    public function index(): JsonResponse
    {
        return response()->json(
            AuthorCollection::make($this->authorService->getList())
        );
    }

    /**
     * @param AuthorRequest $authorRequest
     * @return JsonResponse
     *
     * @OA\Post (
     *  path="/api/authors",
     *  summary="Store author",
     *  description="Store author",
     *     tags={"Author"},
     *     @OA\Response(
     *     response=201,
     *     description="Store author success",
     *      @OA\JsonContent (
     *     type="array",
     *     @OA\Items(
     *     @OA\Property (property="first_name", type="text", example="Имя автора"),
     *     @OA\Property (property="last_name", type="text", example="Фамилия автора"),
     *     @OA\Property (property="surname", type="text", example="Отчество автора"),
     *          )
     *       )
     *     ),
     *     @OA\Response(
     *     response=422,
     *     description="Invalid data",
     *     ),
     *     @OA\Response(
     *     response=404,
     *     description="Not found",
     *     ),
     *     @OA\Response(
     *     response=500,
     *     description="Server error",
     *     ),
     *  requestBody={"$ref": "#/components/requestBodies/AuthorRequest"}
     * ),
     */
    public function store(AuthorRequest $authorRequest): JsonResponse
    {
        return response()->json(
            AuthorResource::make($this->authorService->create(AuthorDTO::from($authorRequest))),
            Response::HTTP_CREATED
        );
    }

    /**
     * @param Author $author
     * @param AuthorRequest $authorRequest
     * @return JsonResponse
     *
     * @OA\Patch  (
     *  path="/api/authors/{author_id}",
     *  summary="Update author",
     *  description="Update author",
     *     tags={"Author"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Author ID",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *     response=200,
     *     description="Update author success",
     *      @OA\JsonContent (
     *     type="array",
     *     @OA\Items(
     *     @OA\Property (property="author_id", type="number", example="ID для обновления автора"),
     *     @OA\Property (property="first_name", type="text", example="Имя автора"),
     *     @OA\Property (property="last_name", type="text", example="Фамилия автора"),
     *     @OA\Property (property="surname", type="text", example="Отчество автора"),
     *          )
     *       )
     *     ),
     *     @OA\Response(
     *     response=422,
     *     description="Invalid data",
     *     ),
     *     @OA\Response(
     *     response=404,
     *     description="Not found",
     *     ),
     *     @OA\Response(
     *     response=500,
     *     description="Server error",
     *     ),
     *  requestBody={"$ref": "#/components/requestBodies/AuthorRequest"}
     * ),
     */
    public function update(Author $author, AuthorRequest $authorRequest): JsonResponse
    {
        return response()->json(
            AuthorResource::make($this->authorService->update($author, AuthorDTO::from($authorRequest)))
        );
    }

    /**
     * @param Author $author
     * @return JsonResponse
     *
     * @OA\Delete  (
     *  path="/api/authors/{author_id}",
     *  summary="Delete author",
     *  description="Delete author",
     *     tags={"Author"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Author ID",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *     response=200,
     *     description="Delete author success",
     *     ),
     *     @OA\Response(
     *     response=422,
     *     description="Invalid data",
     *     ),
     *     @OA\Response(
     *     response=404,
     *     description="Not found",
     *     ),
     *     @OA\Response(
     *     response=500,
     *     description="Server error",
     *     ),
     * ),
     */
    public function destroy(Author $author): JsonResponse
    {
        return response()->json(
            $this->authorService->delete($author)
        );
    }
}
