<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\ListingRequest;
use App\Http\Requests\ReviewStoreRequest;
use App\Http\Requests\ReviewUpdateRequest;
use App\Http\Resources\ReviewStoreResource;
use App\Http\Resources\ReviewUpdateResource;
use App\Repository\ReviewService;

class ReviewController extends Controller {
	private ReviewService $rservice;

	public function __construct(ReviewService $rservice) {
		$this->review_service = $service;
	}
	
	public function getReviews() {
		return ReviewStoreResource::collection($this->review_service->get());
	}

	public function getBooksWithGenre() {
		return response()->json($this->review_service->getBooksWithGenre);
	}

	public function detailReview(ListingRequest $req) {
		$data = $req->validated();
		$id = $data["idToUse"];
		$review = null;
		try {
			$review = $this->review_service->details($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("REVIEW NOT FOUND");
		}
		return response()->json(new ReviewStoreResource($review));
	}

	public function storeReview(ReviewStoreRequest $req) {
		$data = $req->validated();
		$review = $this->review_service->store($data);
		return new ReviewStoreResource($review);
	}

	public function updateReview(ReviewUpdateRequest $req) {
		$data = $req->validated();
		$review = null;
		try {
			$review = $this->review_service->update($id, $data);
		} catch(ModelNotFoundException $e) {
			return response()->json("REVIEW NOT FOUND");
		}
		return new ReviewUpdateResource($review);
	}

	public function deleteReview(ListingRequest $req) {
		$data = $req->validated();
		try {
			$this->review_service->delete($data["idToUse"]);
		} catch(ModelNotFoundException $e) {
			return response()->json("REVIEW NOT FOUND");
		}
	}
}
