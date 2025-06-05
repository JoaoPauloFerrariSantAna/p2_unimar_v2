<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\ReviewModel;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

Route::controller(ReviewController::class)->group(function() {
	Route::get("/review", "getReviews");
	Route::get("/review/{id}", "detailReview");
	Route::post("/review", "storeReview");
	Route::patch("/review/{id}", "updateReview");
	Route::delete("/review/{id}", "deleteReview");
});

Route::controller(GenreController::class)->group(function() {
	Route::get("/genre", "getGenres");
	Route::get("/genre/{id}", "detailGenre");
	Route::get("/genre/book/", "getBooksWithGenre");
	Route::get("/genre/book/{genreId}", "getBookByGenre");
	Route::post("/genre", "storeGenre");
	Route::patch("/genre/{id}", "updateGenre");
	Route::delete("/genre/{id}", "deleteGenre");
});

Route::controller(UserController::class)->group(function() {
	Route::get("/user", "getUsers");
	Route::get("/user/review/", "getReviews");
	Route::get("/user/{id}", "detailUser");
	Route::post("/user", "storeUser");
	Route::patch("/user/{id}", "updateUser");
	Route::delete("/user/{id}", "deleteUser");
});

Route::controller(BookController::class)->group(function() {
	Route::get("/book", "getBooks");
	Route::get("/book/{id}", "detailBook");
	Route::post("/book", "storeBook");
	Route::patch("/book/{id}", "updateBook");
	Route::delete("/book/{id}", "deleteBook");
});

Route::controller(AuthorController::class)->group(function() {
	Route::get("/author", "getAuthors");
	Route::get("/author/{id}", "detailAuthor");
	Route::post("/author", "storeAuthor");
	Route::patch("/author/{id}", "updateAuthor");
	Route::delete("/author/{id}", "deleteAuthor");
});
