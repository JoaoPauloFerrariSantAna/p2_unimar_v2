<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\ScoreModel;

class ScoreController extends Controller
{
	public function getScores()
	{
		return response()->json(ScoreModel::all());
	}

	public function detailScore(int $id)
	{
		$score = null;
		try
		{
			$score = ScoreModel::findOrFail($id);
		}
		catch(ModelNotFoundException $e)
		{
			return response()->json("SCORE NOT FOUND");
		}
		return response()->json($score);
	}

	public function storeScore(Request $req)
	{
		$score				= new ScoreModel();
		$score->name		= $req->input("aname", null);
		$score->birthDay	= $req->input("abday", null);
		$score->biograph 	= $req->input("abio", null);
		$score->save();
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
			$author = ScoreModel::findOrFail($id);
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
			$author = ScoreModel::findOrFail($id);
		}
		catch(ModelNotFoundException $e)
		{
			return response()->json("AUTHOR NOT FOUND");
		}
		$author->delete();
		return response()->json($author);
	}
}
