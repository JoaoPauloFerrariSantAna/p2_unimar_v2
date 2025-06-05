<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\AuthorStoreRequest;
use App\Http\Requests\AuthorUpdateRequest;
use App\Models\AuthorModel;

class AuthorController extends Controller {
	public function getAuthors() {
		return response()->json(AuthorModel::all());
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