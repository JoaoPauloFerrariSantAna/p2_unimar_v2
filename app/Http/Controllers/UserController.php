<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\UserModel;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserStoreResource;
use App\Http\Resources\UserUpdateResource;
use App\Models\ReviewModel;

class UserController extends Controller {
	public function getUsers() {
		$users = UserModel::all();
		return UserStoreResource::collection($users);
	}

	// there is no need to be too specific here 
	public function getReviews(Request $req) {
		$review_id = $req->input("review_id");
		$user_id = $req->input("user_id");
		$user_reviews = null;
		try {
			$user_reviews = ReviewModel::findOrFail($review_id);
		} catch(ModelNotFoundException $e) {
			return response()->json("REVIEW NOT FOUND!");
		}
		$user_reviews->user()->associate($user_id);
		return response()->json($user_reviews);
	}

	public function detailUser(int $id) {
		$user = null;
		try {
			$user = UserModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("USER NOT FOUND");
		}
		return new UserStoreResource($user);
	}

	public function storeUser(UserStoreRequest $req) {
		$data = $req->validated();
		$user = UserModel::create($data);
		return new UserStoreResource($user);
	}

	public function updateUser(UserUpdateRequest $req, int $id) {
		$data = $req->validated();
		$user = null;
		try {
			$user = UserModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("USER NOT FOUND");
		}
		$user->update($data);
		return new UserUpdateResource($user);
	}

	public function deleteUser(int $id) {
		$user = null;
		try {
			$user = UserModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("USER NOT FOUND");
		}
		$user->delete();
	}
}
