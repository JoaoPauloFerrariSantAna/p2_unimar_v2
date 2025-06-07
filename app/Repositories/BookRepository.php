<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\BookModel;

class BookRepository {
	public function get() {
		return response()->json(BookModel::all());
	}

	public function getBooksReview(int $review_id) {
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

	public function getBookByGenre(int $genre_id) {
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
		return $data;
	}

	// we are using authorId here because it makes sense
	// who created the book was the author, so the author is unique in relation to a book
	public function getBookGeneralInfomation(int $author_id) {
		$query = "SELECT
			book_tbl.title AS BOOK_TITLE,
			book_tbl.summary AS BOOK_SUMMARY,
			review_tbl.review AS BOOK_REVIEW,
			review_tbl.score AS BOOK_SCORE,
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
		return $data;
	}

	public function details(int $id) {
		return BookModel::findOrFail($id);
	}

	public function storeBook(array $data) {
		$book = BookModel::create($data);
		return $book;
	}

	public function updateBook(array $data, int $id) {
		$book = null;
		try {
			$book = $this->details($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("BOOK NOT FOUND");
		}
		$book->update($data);
		return $book;
	}

	public function deleteBook(array $data, int $id) {
		$book = null;
		try {
			$book = $this->details($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("BOOK NOT FOUND");
		}
		$book->delete();
	}
}