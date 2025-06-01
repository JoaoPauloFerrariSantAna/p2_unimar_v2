<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\GenreStoreRequest;
use App\Http\Requests\GenreUpdateRequest
use App\Models\GenreModel;

class GenreController extends Controller
{
	public function getGenres() {
		return response()->json(GenreModel::all());
	}

	public function detailGenre(int $id) {
		$genre = null;
		try {
			$genre = GenreModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("genre NOT FOUND");
		}
		return response()->json($genre);
	}

	public function storeGenre(GenreStoreRequest $req) {
		$data = $req->validaded();
		$genre = GenreModel::create($data);
		return response()->json($genre);
	}

	public function updateGenre(GenreUpdateRequest $req, int $id) {			
		$data = $req->validaded();
		$genre = null;
		try {
			$genre = GenreModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("GENRE NOT FOUND");
		}
	}

	public function deleteGenre(int $id) {
		$genre = null;
		try {
			$genre = GenreModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("GENRE NOT FOUND");
		}
		$genre->delete();
	}
}
