<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\AuthorStoreRequest;
use App\Http\Requests\AuthorUpdateRequest;
use App\Http\Requests\ListingRequest;
use App\Http\Resources\AuthorStoreResource;
use App\Http\Resources\AuthorUpdateResource;
use App\Services\AuthorService;

class AuthorController extends Controller {
	private AuthorService $author_serv;

	public function __construct(AuthorService $author_serv) {
		$this->author_serv = $author_serv;
	}

	public function getAuthors() {
		return AuthorStoreResource::collection($this->author_serv->get());
	}

	public function getAuthorsBooks() {
		return AuthorStoreResource::collection($this->author_serv->getAuthorsBooks());
	}

	public function detailAuthor(ListingRequest $req) {
		$data = $req->validated();
		$id = $data["idToUse"];
		$author = $this->author_serv->details($id);
		return new AuthorStoreResource($author);
	}

	public function storeAuthor(AuthorStoreRequest $req) {
		$data = $req->validated();
		$author = $this->author_serv->store($data);
		return response()->json(new AuthorStoreResource($author));
	}

	public function updateAuthor(AuthorUpdateRequest $req_info, ListingRequest $req_id) {
		$data_author = $req_info->validated();
		$data_id = $req_id->validated();
		$id = $data_id["idToUse"];
		$author = null;

		try {
			$author = $this->author_serv->update($data_author, $id);
		} catch(ModelNotFoundException $e) {
			return response()->json("AUTHOR NOT FOUND");
		}

		return new AuthorUpdateResource($author);
	}

	public function deleteAuthor(ListingRequest $req) {
		$data= $req_id->validated();
		$id = $data_id["idToUse"];
		$author = null;
		try {
			$author = $this->author_serv->delete($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("AUTHOR NOT FOUND");
		}
	}
}
