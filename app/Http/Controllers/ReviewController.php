<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\ReviewModel;
use App\Http\Requests\ListingRequest;
use App\Http\Requests\ReviewStoreRequest;
use App\Http\Requests\ReviewUpdateRequest;
use App\Http\Resources\ReviewStoreResource;
use App\Http\Resources\ReviewUpdateResource;

class ReviewController extends Controller
{
	public function getReviews() {
		return ReviewStoreResource::collection(ReviewModel::all());
	}

	public function getBooksWithGenre() {
		// i prefer to do theses queries on raw sql :v
		$query = "SELECT
			book_tbl.title AS BOOK_TITLE,
			book_tbl.summary AS BOOK_SUMMARY,
			genre_tbl.name AS BOOK_GENRE
		FROM
			book_tbl
		INNER JOIN
			genre_tbl
		ON
			book_tbl.genre_id = genre_tbl.id";
		$data = DB::select($query);
		return response()->json($data);
	}

	public function detailReview(ListingRequest $req) {
		$data = $req->validated();
		$id = $data["idToUse"];
		$review = null;
		try {
			$review = ReviewModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("REVIEW NOT FOUND");
		}
		return response()->json(new ReviewStoreResource($review));
	}

	public function storeReview(ReviewStoreRequest $req) {
		$data = $req->validated();
		$review = ReviewModel::create($data);
		return new ReviewStoreResource($review);
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
		return new ReviewUpdateResource($review);
	}

	public function deleteReview(ListingRequest $req) {
		$data = $req->validated();
		$id = $data["idToUse"];
		$review = null;
		try {
			$review = ReviewModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("REVIEW NOT FOUND");
		}
		$review->delete();
		return new ReviewStoreResource($review);
	}
}
