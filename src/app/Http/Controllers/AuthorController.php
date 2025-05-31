<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\AuthorModel;

class AuthorController extends Controller
{
	public function getAuthors()
	{
		return response()->json(AuthorModel::all());
	}

	public function detailAuthor(int $id)
	{
		$author = null;
		try
		{
			$author = AuthorModel::findOrFail($id);
		}
		catch(ModelNotFoundException $e)
		{
			return response()->json("AUTHOR NOT FOUND");
		}
		return response()->json($author);
	}

	public function storeAuthor(Request)
	{
		$author				= new AuthorModel();
		$author->name		= $req->input("aname", null);
		$author->birthDay	= $req->input("abday", null);
		$author->biograph 	= $req->input("abio", null);
		$author->save();
		return response()->json($author);
	}

	public function updateAuthor(Request $req, int $id)
	{
		// why would we want to update someone's birthday?!
		$author		= null;
		$newName	= $req->input("aname", null);
		$newBio		= $req->input("abio", null);
		try
		{
			$author = AuthorModel::findOrFail($id);
		}
		catch(ModelNotFoundException $e)
		{
			return response()->json("AUTHOR NOT FOUND");
		}
		if($newName != null) {
			$book->name = $newName;
		}
		if($newBio != null) {
			$book->biograph = $newBio;
		}
		return response()->json($author);
	}

	public function deleteAuthor(int $id)
	{
		$author = null;
		try
		{
			$author = AuthorModel::findOrFail($id);
		}
		catch(ModelNotFoundException $e)
		{
			return response()->json("AUTHOR NOT FOUND");
		}
		$author->delete();
		return response()->json($author);
	}
}
