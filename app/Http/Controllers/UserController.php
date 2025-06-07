<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\UserModel;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserStoreResource;
use App\Http\Resources\UserUpdateResource;
use App\Http\Requests\ListingRequest;
use App\Models\ReviewModel;
use App\Services\UserService;

class UserController extends Controller {
	private UserService $user_service;
	
	public function __construct(UserService $user_service) {
		$this->user_serv = $user_service;
	}

	public function getUsers() {
		return UserStoreResource::collection($this->user_serv->get());
	}

	// there is no need to be too specific here 
	public function getReviews(Request $req) {
		$user_id = $req->input("user_id");
		$review_id = $req->input("review_id");
		$user_reviews = null;
		try {
			$user_reviews = $this->user_serv->getReviews($user_id, $review_id);;
		} catch(ModelNotFoundException $e) {
			return response()->json("REVIEW NOT FOUND!");
		}
		return response()->json($user_reviews);
	}

	public function detailUser(ListingRequest $req) {
		$data = $req->validated();
		$id = $data["idToUse"];
		$user = null;
		try {
			$user = $this->user_serv->details($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("USER NOT FOUND");
		}
		return new UserStoreResource($user);
	}

	public function storeUser(UserStoreRequest $req) {
		$data = $req->validated();
		$user = $this->user_serv->store($data);
		return new UserStoreResource($user);
	}

	public function updateUser(UserUpdateRequest $req_user, ListingRequest $req_id) {
		$data_user = $req_user->validated();
		$data_id = $req_id->validated();
		$user = null;
		try {
			$user = $this->user_serv->update($data_id["idToUse"], $data_user);
		} catch(ModelNotFoundException $e) {
			return response()->json("USER NOT FOUND");
		}
		return new UserUpdateResource($user);
	}

	public function deleteUser(ListingRequest $req) {
		$data = $req->validated();
		try {
			$this->user_serv->delete($data["idToUse"]);
		} catch(ModelNotFoundException $e) {
			return response()->json("USER NOT FOUND");
		}
		return response()->json("USER DELETED");
	}
}
