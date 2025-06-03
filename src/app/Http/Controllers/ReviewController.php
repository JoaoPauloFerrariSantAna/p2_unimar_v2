<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\ReviewModel;
use App\Http\Requests\ReviewStoreRequest;
use App\Http\Requests\ReviewUpdateRequest;

class ReviewController extends Controller
{
	public function getReviews() {
		return response()->json(ReviewModel::all());
	}

	public function detailReview(int $id) {
		$review = null;
		try {
			$review = ReviewModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("REVIEW NOT FOUND");
		}
		return response()->json($review);
	}

	public function storeReview(ReviewStoreRequest $req) {
		$data = $req->validaded();
		$review = ReviewModel::create($data);
		return response()->json($user);
	}

	public function updateReview(ReviewUpdateRequest $req) {
		$data = $req->validated();
		$review = null;
		try {
			$review = ReviewModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("REVIEW NOT FOUND");
		}
		$review->update($data);
		return response()->json($review);
	}

	public function deleteReview(int $id) {
		$review = null;
		try {
			$review = ReviewModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("REVIEW NOT FOUND");
		}
		$review->delete();
		return response()->json($review);
	}
}
