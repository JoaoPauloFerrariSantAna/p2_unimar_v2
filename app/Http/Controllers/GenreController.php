<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\GenreStoreRequest;
use App\Http\Requests\GenreUpdateRequest;
use App\Http\Requests\ListingRequest;
use App\Services\GenreService;


class GenreController extends Controller {
	private GenreService $genre_service;

	public function __construct(GenreService $genre_service) {
		$this->genre_service = $genre_service;
	}

	public function getGenres() {
		return response()->json($this->genre_service->get());
	}

	public function detailGenre(ListingRequest $req) {
		$data = $req->validated();
		$id = $data["idToUse"];
		$genre = null;
		try {
			$genre = $this->genre_service->details($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("GENRE NOT FOUND");
		}
		return response()->json($genre);
	}

	public function storeGenre(GenreStoreRequest $req) {
		$data = $req->validated();
		$genre = $this->genre_service->store($data);
		return response()->json($genre);
	}

	public function updateGenre(GenreUpdateRequest $req_genre, ListingRequest $req_id) {
		$data_genre = $req_genre->validated();
		$data_id = $req_id->validated();
		$id = $data_id["idToUse"];
		$genre = null;
		try {
			$genre = $this->genre_service->update($data_genre, $id);;
		} catch(ModelNotFoundException $e) {
			return response()->json("GENRE NOT FOUND");
		}
		return response()->json($genre);
	}

	public function deleteGenre(ListingRequest $req) {
		$data = $req->validated();
		$id = $data["idToUse"];
		try {
			$this->genre_service->delete($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("GENRE NOT FOUND");
		}
	}
}
