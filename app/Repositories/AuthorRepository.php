<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\AuthorModel;

class AuthorRepository {
	public function get() {
		$authors = AuthorModel::all();
		return AuthorModel::all();
	}

	public function getAuthorsBooks() {
		$query = "SELECT
			author_tbl.name AS AUTHOR_NAME,
			book_tbl.title AS BOOK_NAME,
			book_tbl.summary AS SUMMARY
		FROM
			author_tbl
		JOIN
			book_tbl
		ON
			author_tbl.id = book_tbl.author_id;";
		$data = DB::select($query);
		return $data;
	}

	public function getAuthorBooks(array $data, int $author_id) {
		$query = "SELECT
			author_tbl.name AS AUTHOR_NAME,
			book_tbl.title AS BOOK_NAME,
			book_tbl.summary AS SUMMARY
		FROM
			author_tbl
		JOIN
			book_tbl
		ON
			author_tbl.id = book_tbl.author_id
		WHERE
			author_tbl.id = $author_id";
		$data = DB::select($query);
		return $data;
	}

	public function details(int $id) {
		return AuthorModel::findOrFail($id);
	}

	public function store(array $data) {
		$author = AuthorModel::create($data);
		return $author;
	}

	public function update(array $data, int $id) {
		// why would we want to update someone's birthday?!
		$author = null;
		try {
			$author = $this->details($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("AUTHOR NOT FOUND");
		}
		$author->update($data);
		return $author;
	}

	public function deleteAuthor(int $id) {
		$author = null;
		try {
			$author = $this->details($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("AUTHOR NOT FOUND");
		}
		$author->delete();
	}
}