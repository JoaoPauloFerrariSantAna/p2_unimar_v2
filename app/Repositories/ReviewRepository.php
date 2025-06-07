<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\ReviewModel;

class ReviewRepository {
	public function get() {
		return ReviewModel::all();
	}

	public function details(int $id) {
		return ReviewModel::findOrFail($id);
	}

	public function store(array $data) {
		return ReviewModel::create($data);
	}

	public function update(int $id, array $data) {
		$review = $this->details($id);
		$review->update($data);
		return $review;
	}

	public function delete(int $id) {
		$user = $this->details($id);
		$user->delete();
	}

	public function getBooksWithGenre() {
		// i prefer to do theses queries on raw sql :v
		$query = "SELECT
			book_tbl.title AS BOOK_TITLE,
			book_tbl.summary AS BOOK_SUMMARY,
			genre_tbl.name AS BOOK_GENRE
		FROM
			book_tbl
		INNER JOIN
			genre_tbl
		ON
			book_tbl.genre_id = genre_tbl.id";
		$data = DB::select($query);
		return response()->json($data);
	}
}
