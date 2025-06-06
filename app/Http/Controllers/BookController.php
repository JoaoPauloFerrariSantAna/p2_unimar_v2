<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Http\Requests\ListingRequest;
use App\Models\BookModel;

class BookController extends Controller {
	public function getBooks() {
		return response()->json(BookModel::all());
	}

	public function getBooksReview(ListingRequest $req) {
		$data = $req->validated();
		$review_id = $data["idToUse"];
		$query = "SELECT
			book_tbl.title, review_tbl.review
		FROM
			book_tbl
		JOIN
			review_tbl
		ON
			book_tbl.review_id = review_tbl.id
		WHERE
			review_tbl.id =  $review_id";
		$data = DB::select($query);
		return response()->json($data);
	}

	public function getBookByGenre(ListingRequest $req) {
		$data = $req->validated();
		$genre_id = $data["idToUse"];
		$query = "SELECT
				genre_tbl.name, book_tbl.title, book_tbl.summary
			FROM
				book_tbl
			INNER JOIN 
				genre_tbl
			ON
				book_tbl.genre_id = genre_tbl.id
			WHERE
				genre_tbl.id = $genre_id";
		$data = DB::select($query);
		return response()->json($data);
	}

	// we are using authorId here because it makes sense
	// who created the book was the author, so the author is unique in relation to a book
	public function getBookGeneralInfomation(ListingRequest $req) {
		$data = $req->validated();
		$author_id = $data["idToUse"];
		$query = "SELECT
			book_tbl.title AS BOOK_TITLE,
			book_tbl.summary AS BOOK_SUMMARY,
			review_tbl.review AS BOOK_REVIEW,
			author_tbl.name AS BOOK_AUTHOR,
			genre_tbl.name AS BOOK_GENRE
		FROM
			book_tbl
		JOIN
			review_tbl
		ON
			book_tbl.review_id = review_tbl.id
		JOIN
		author_tbl
		ON
			book_tbl.author_id = author_tbl.id
		JOIN
			genre_tbl
		ON
			book_tbl.genre_id = genre_tbl.id
		WHERE
			author_tbl.id = $author_id";
		$data = DB::select($query);
		return response()->json($data);
	}

	public function detailBook(ListingRequest $req) {
		$data = $req->validated();
		$id = $data["idToUse"];
		$book = null;
		try {
			$book = BookModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("BOOK NOT FOUND");
		}
		return response()->json($book);
	}

	public function storeBook(BookStoreRequest $req) {
		$data = $req->validated();
		$book = BookModel::create($data);
		return response()->json($book);
	}

	public function updateBook(BookUpdateRequest $req_book, ListingRequest $req_id) {
		$data_book = $req_book->validated();
		$data_id = $req_id->validated();
		$id = $data_id["idToUse"];
		$book = null;
		try {
			$book = BookModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("BOOK NOT FOUND");
		}
		$book->update($data);
		return response()->json($book);
	}

	public function deleteBook(ListingRequest $req) {
		$data = $req->validated();
		$id = $data["idToUse"];
		$book = null;
		try {
			$book = BookModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("BOOK NOT FOUND");
		}
		$book->delete();
		return response()->json($book);
	}
}
