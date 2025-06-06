<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\AuthorStoreRequest;
use App\Http\Requests\AuthorUpdateRequest;
use App\Models\AuthorModel;

class AuthorController extends Controller {
	public function getAuthors() {
		return response()->json(AuthorModel::all());
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
		return response()->json($data);
	}

	public function getAuthorBooks(int $author_id) {
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
		return response()->json($data);
	}

	public function detailAuthor(int $id) {
		$author = null;
		try {
			$author = AuthorModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("AUTHOR NOT FOUND");
		}
		return response()->json($author);
	}

	public function storeAuthor(AuthorStoreRequest $req) {
		$data = $req->validated();
		$author = AuthorModel::create($data);
		return response()->json($author);
	}

	public function updateAuthor(AuthorUpdateRequest $req, int $id) {
		// why would we want to update someone's birthday?!
		$data = $req->validated();
		$author = null;
		try {
			$author = AuthorModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("AUTHOR NOT FOUND");
		}
		$author->update($data);
		return response()->json($author);
	}

	public function deleteAuthor(int $id) {
		$author = null;
		try {
			$author = AuthorModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("AUTHOR NOT FOUND");
		}
		$author->delete();
		return response()->json($author);
	}
}
