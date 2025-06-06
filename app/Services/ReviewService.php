<?php

namespace App\Services;

use App\Repositories\ReviewRepository;

class UserService {
	private ReviewRepository $user_repo;

	public function __construct(ReviewRepository $user_repo) {
		$this->rrepo = $user_repo;
	}

	public function get() {
		return $this->rrepo->get();
	}

    public function details(int $id) {
		return $this->rrepo->details($id);
	}

	public function store(array $data) {
		return $this->rrepo->store($data);
	}

	public function update(int $id, array $data) {
        return $this->rrepo->update($id, $data);
	}

    public function delete(int $id) {
        $this->rrepo->delete($id);
    }

	public function getBooksWithGenre() {
		return $this->rrepo->getBooksWithGenre();
	}

	public function getBooksWithGenre() {
		return $this->rrepo->getBooksWithGenre();
	}
}
