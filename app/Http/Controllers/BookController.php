<?php

namespace App\Http\Controllers;

use App\DTO\BookDTO;
use App\Http\Requests\BookRequest;
use App\Http\Resources\Book\BookCollection;
use App\Http\Resources\Book\BookResource;
use App\Models\Author;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;

class BookController extends Controller
{
    public function __construct(private readonly BookService $bookService)
    {
    }

    /**
     * @return JsonResponse
     * @OA\Get  (
     *  path="/api/books",
     *  summary="Get books",
     *  description="Get books",
     *     tags={"Book"},
     *     @OA\Response(
     *     response=200,
     *     description="Get books",
     *         @OA\JsonContent (
     *         type="array",
     *             @OA\Items (
     *                 ref="#/components/schemas/BookCollection"
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
            BookCollection::make($this->bookService->getList())
        );
    }

    /**
     * @param BookRequest $bookRequest
     * @return JsonResponse
     *
     * @OA\Post (
     *  path="/api/books",
     *  summary="Store book",
     *  description="Store book",
     *     tags={"Book"},
     *     @OA\Response(
     *     response=201,
     *     description="Store book success",
     *      @OA\JsonContent (
     *     type="array",
     *     @OA\Items(
     *     @OA\Property (property="authors_ids", type="number", example="authors_ids[] Передаем Ids авторов в массиве"),
     *     @OA\Property (property="title", type="text", example="Название книги"),
     *     @OA\Property (property="genre_id", type="number", example="ID жанра книги"),
     *     @OA\Property (property="description", type="text", example="Описание книги"),
     *     @OA\Property (property="age", type="number", example="Год выпуска книги"),
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
     *  requestBody={"$ref": "#/components/requestBodies/BookRequest"}
     * ),
     */
    public function store(BookRequest $bookRequest): JsonResponse
    {
        $newBook = $this->bookService->create(BookDTO::from($bookRequest));

        return response()->json(
        BookResource::make($newBook)
        );
    }

    /**
     * @param Book $book
     * @param BookRequest $bookRequest
     * @return JsonResponse
     *
     * @OA\Patch (
     *  path="/api/books",
     *  summary="Update book",
     *  description="Update book",
     *     tags={"Book"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Book ID",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *     response=200,
     *     description="Update book success",
     *      @OA\JsonContent (
     *     type="array",
     *     @OA\Items(
     *     @OA\Property (property="authors_ids", type="number", example="authors_ids[] Передаем Ids авторов в массиве"),
     *     @OA\Property (property="title", type="text", example="Название книги"),
     *     @OA\Property (property="genre_id", type="number", example="ID жанра книги"),
     *     @OA\Property (property="description", type="text", example="Описание книги"),
     *     @OA\Property (property="age", type="number", example="Год выпуска книги"),
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
     *  requestBody={"$ref": "#/components/requestBodies/BookRequest"}
     * ),
     */
    public function update(Book $book,BookRequest $bookRequest): JsonResponse
    {
        $book = $this->bookService->update($book,BookDTO::from($bookRequest));

        return response()->json(
            BookResource::make($book)
        );
    }

    /**
     * @param Book $book
     * @return JsonResponse
     *
     * @OA\Get  (
     *  path="/api/books/{book_id}",
     *  summary="Get book",
     *  description="Get book",
     *     tags={"Book"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Book ID",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *     response=200,
     *     description="Get book",
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
    public function show(Book $book): JsonResponse
    {
        return response()->json(
            BookResource::make($book)
        );
    }

    /**
     * @param Author $author
     * @return JsonResponse
     *
     * @OA\Get  (
     *  path="/api/books/author/{author_id}",
     *  summary="Get author books",
     *  description="Get author books",
     *     tags={"Book"},
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
     *     description="Get author books",
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
    public function getListBooksByAuthor(Author $author): JsonResponse
    {
        return response()->json(
            $this->bookService->getListBooksByAuthor($author)
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @OA\Get  (
     *  path="/api/books/genres",
     *  summary="Get books for genres",
     *  description="Get books for genres",
     *     tags={"Book"},
     *     @OA\Response(
     *     response=200,
     *     description="Get books for genres success",
     *      @OA\JsonContent (
     *     type="array",
     *     @OA\Items(
     *     @OA\Property (property="genres", type="text", example="genres[] Передаем название жанров в массиве пример - ['Приключения', 'Исторический']"),
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
     * ),
     */
    public function getListBooksByGenres(Request $request): JsonResponse
    {
        return response()->json(
            BookCollection::make(
                $this->bookService->getList('genre', $request->get('genres'))
            )
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @OA\Get  (
     *  path="/api/books/age",
     *  summary="Get books for age",
     *  description="Get books for age",
     *     tags={"Book"},
     *     @OA\Response(
     *     response=200,
     *     description="Get books for age success",
     *      @OA\JsonContent (
     *     type="array",
     *     @OA\Items(
     *     @OA\Property (property="from", type="number", example="Начало годов выпуска книги пример='2000'"),
     *     @OA\Property (property="to", type="number", example="Конец годов выпуска книги пример='2023'"),
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
     * ),
     */
    public function getListBooksByAge(Request $request): JsonResponse
    {
        return response()->json(
            BookCollection::make(
                $this->bookService
                    ->getList('age', [$request->from, $request->to])
            )
        );
    }
}
