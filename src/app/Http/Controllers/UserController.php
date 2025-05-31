<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\UserModel;

class UserController extends Controller
{
	public function getUsers()
	{
		return response()->json(UserModel::all());
	}

	public function detailUser(int $id)
	{
		$user = null;

		try
		{
			$user = UserModel::findOrFail($id);
		}
		catch(ModelNotFoundException $e)
		{
			return response()->json("USER NOT FOUND");
		}

		return response()->json($user);
	}

	public function storeUser(Request $req)
	{
		$user			= new users();
		$user->username = $req->input("usrn", null);
		$user->email	= $req->input("usre");
		$user->passwd	= $req->input("usrp", null);
		$user->save();
		return response()->json($user);
	}

	public function updateUser(Request $req, int $id)
	{
		$user		= null;
		$newName	= $req->input("usrn", null);
		$newEmail	= $req->input("usre", null);
		$newPasswd	= $req->input("usrp", null);

		try
		{
			$user = UserModel::findOrFail($id);
		}
		catch(ModelNotFoundException $e)
		{
			return response()->json("USER NOT FOUND");
		}

		if($newName != null) {
			$user->username = $newName;
		}

		if($newEmail != null) {
			$user->email = $newEmail;
		}

		if($newPasswd != null) {
			$user->passwd = $newPasswd;
		}

		$user->save();

		return response()->json($user);
	}

	public function deleteUser(int $id)
	{
		$user = null;

		try
		{
			$user = UserModel::findOrFail($id);
		}
		catch(ModelNotFoundException $e)
		{
			return response()->json("USER NOT FOUND");
		}

		$user->delete();
	}
}
