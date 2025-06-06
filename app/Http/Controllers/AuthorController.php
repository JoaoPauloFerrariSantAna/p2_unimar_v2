<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\AuthorStoreRequest;
use App\Http\Requests\AuthorUpdateRequest;
use App\Http\Requests\ListingRequest;
use App\Models\AuthorModel;
use App\Http\Resources\AuthorStoreResource;
use App\Http\Resources\AuthorUpdateResource;

class AuthorController extends Controller {
	public function getAuthors() {
		$authors = AuthorModel::all();
		return AuthorStoreResource::collection($authors);
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
		return AuthorStoreResource::collection($data);
	}

	public function getAuthorBooks(ListingRequest $req) {
		$data = $req->validated();
		$author_id = $data["idToUse"];
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
		return response()->json(AuthorStoreResource::collection($data));
	}

	public function detailAuthor(ListingRequest $req) {
		$data = $req->validated();
		$id = $data["idToUse"];
		$author = null;
		try {
			$author = AuthorModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("AUTHOR NOT FOUND");
		}
		return new AuthorStoreResource($author);
	}

	public function storeAuthor(AuthorStoreRequest $req) {
		$data = $req->validated();
		$author = AuthorModel::create($data);
		return response()->json(new AuthorStoreResource);
	}

	public function updateAuthor(AuthorUpdateRequest $req_info, ListingRequest $req_id) {
		// why would we want to update someone's birthday?!
		$data_author = $req_info->validated();
		$data_id = $req_id->validated();
		$id = $data_id["idToUse"];
		$author = null;
		try {
			$author = AuthorModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("AUTHOR NOT FOUND");
		}
		$author->update($data);
		return new AuthorUpdateResource($author);
	}

	public function deleteAuthor(ListingRequest $req) {
		$data= $req_id->validated();
		$id = $data_id["idToUse"];
		$author = null;
		try {
			$author = AuthorModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("AUTHOR NOT FOUND");
		}
		$author->delete();
		return response()->json(new AuthorStoreResource($author));
	}
}
