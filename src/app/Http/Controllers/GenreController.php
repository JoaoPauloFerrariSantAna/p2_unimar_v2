<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\GenreModel;

class GenreController extends Controller
{
	public function getGenres
	{
		return response()->json(GenreModel::all());
	}

	public function detailGenre(int $id)
	{
		$genre = null;
		try
		{
			$genre = GenreModel::findOrFail($id);
		}
		catch(ModelNotFoundException $e)
		{
			return response()->json("genre NOT FOUND");
		}
		return response()->json($genre);
	}

	public function storeGenre(Request $req)
	{
		$genre			= new GenreModel();
		$genre->name	= $req->input("gname", null);
		$genre->save();
		return response()->json($genre);
	}

	public function updateGenre(Request $req, int $id)
	{			
		$genre		= null;
		$newName	= $req->input("gname", null);
		try
		{
			$genre = GenreModel::findOrFail($id);
		}
		catch(ModelNotFoundException $e)
		{
			return response()->json("genre NOT FOUND");
		}
		if($newName != null) {
			$genre->name = $newName;
		}
		$genre->save();
		return response()->json($genre);
	}

	public function deleteGenre(int $id)
	{
		$genre = null;
		try
		{
			$genre = GenreModel::findOrFail($id);
		}
		catch(ModelNotFoundException $e)
		{
			return response()->json("GENRE NOT FOUND");
		}
		$genre->delete();
	}
}
