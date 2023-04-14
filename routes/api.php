<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/books/genres', [BookController::class, 'getListBooksByGenres']);
Route::get('/books/age', [BookController::class, 'getListBooksByAge']);
Route::get('/books/author/{author}', [BookController::class, 'getListBooksByAuthor']);

Route::apiResource('books', BookController::class);
Route::apiResource('authors', AuthorController::class);


