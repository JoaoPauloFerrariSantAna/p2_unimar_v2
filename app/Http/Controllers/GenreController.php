<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\GenreStoreRequest;
use App\Http\Requests\GenreUpdateRequest;
use App\Http\Requests\ListingRequest;
use App\Models\GenreModel;

class GenreController extends Controller
{
	public function getGenres() {
		return response()->json(GenreModel::all());
	}

	public function detailGenre(ListingRequest $req) {
		$data = $req->validated();
		$id = $data["idToUse"];
		$genre = null;
		try {
			$genre = GenreModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("GENRE NOT FOUND");
		}
		return response()->json($genre);
	}

	public function storeGenre(GenreStoreRequest $req) {
		$data = $req->validated();
		$genre = GenreModel::create($data);
		return response()->json($genre);
	}

	public function updateGenre(GenreUpdateRequest $req_genre, ListingRequest $req_id) {
		$data_genre = $req_genre->validated();
		$data_id = $req_id->validated();
		$id = $data_id["idToUse"];
		$genre = null;
		try {
			$genre = GenreModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("GENRE NOT FOUND");
		}
	}

	public function deleteGenre(ListingRequest $req) {
		$data = $req->validated();
		$id = $data["idToUse"];
		$genre = null;
		try {
			$genre = GenreModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("GENRE NOT FOUND");
		}
		$genre->delete();
	}
}
