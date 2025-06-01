<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\ReviewModel;

class ReviewController extends Controller
{
	public function getReviews()
	{
		return response()->json(ReviewModel::all());
	}

	public function detailReview(int $id)
	{
		$review = null;
		try
		{
			$review = ReviewModel::findOrFail($id);
		}
		catch(ModelNotFoundException $e)
		{
			return response()->json("REVIEW NOT FOUND");
		}
		return response()->json($review);
	}

	public function storeReview(Request $req)
	{
		$review = new ReviewModel();
		$review->score = $req->input("rscore", null);
		$review->review = $req->input("rreview", null);
		$review->save();
		return response()->json($review);
	}

	public function updateReview(Request $req)
	{
		$review		= null;
		$newScore	= $req->input("rscore", null);
		$newReview	= $req->input("rreview", null);
		try
		{
			$review = ReviewModel::findOrFail($id);
		}
		catch(ModelNotFoundException $e)
		{
			return response()->json("REVIEW NOT FOUND");
		}
		if($newScore != null) {
			$review->score = $newScore;
		}
		if($newReview != null) {
			$review->review = $newReview;
		}
		$review->save();
		return response()->json($review);
	}

	public function deleteReview(int $id)
	{
		$review = null;
		try
		{
			$review = ReviewModel::findOrFail($id);
		}
		catch(ModelNotFoundException $e)
		{
			return response()->json("REVIEW NOT FOUND");
		}
		$review->delete();
		return response()->json($review);
	}
}
