<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserModel;
use App\Models\ReviewModel;

class UserRepository {
	public function get() {
		return UserModel::all();
	}

	public function details(int $id) {
		return UserModel::findOrFail($id);
	}

	// cause we are assotiating
	private function detailReviewClass(int $id) {
		return ReviewModel::findOrFail($id);
	}

	public function store(array $data) {
		return UserModel::create($data);
	}

	public function update(int $user_id, array $data) {
		$user = $this->details($user_id);
		$user->update($data);
		return $user;
	}

	public function delete(int $user_id) {
		$user = $this->details($user_id);
		$user->delete();
	}

	public function getReviews(int $user_id, $review_id) {
		$user_reviews = $this->detailReviewClass($review_id);
		$user_reviews->user()->associate($user_id);
		return $user_reviews;
	}
}
