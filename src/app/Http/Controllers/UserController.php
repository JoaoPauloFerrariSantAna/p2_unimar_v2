<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\UserModel;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller {
	public function getUsers() {
		return response()->json(UserModel::all());
	}

	public function detailUser(int $id) {
		$user = null;
		try {
			$user = UserModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("USER NOT FOUND");
		}
		return response()->json($user);
	}

	public function storeUser(UserStoreRequest $req) {
		$data = $req->validaded();
		$user = UserModel::create($data);
		return response()->json($user);
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
		return response()->json($user);
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
