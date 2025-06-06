<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService {
	private UserRepository $user_repo;

	public function __construct(UserRepository $user_repo) {
		$this->urepo = $user_repo;
	}

	public function get() {
		return $this->urepo->get();
	}

    public function details(int $id) {
		return $this->urepo->details($id);
	}

	public function store(array $data) {
		return $this->urepo->store($data);
	}

	public function update(int $id, array $data) {
        return $this->urepo->update($id, $data);
	}

    public function delete(int $id) {
        $this->urepo->delete($id);
    }

	public function getReviews(int $uid, int $rid) {
		return $this->urepo->getReviews($uid, $rid);
	}
}
