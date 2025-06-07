<?php

namespace App\Services;

use App\Repositories\AuthorRepository;

class AuthorService {
    private AuthorRepository $author_repo;

    public function __construct(AuthorRepository $author_repo) {
        $this->author_repo = $author_repo;
    }

	public function get() {
		return $this->author_repo->get();
	}

	public function getAuthorsBooks() {
		return $this->author_repo->getAuthorsBooks();
	}

	public function details(int $id) {
		return $this->author_repo->details($id);
	}

	public function store(array $data) {
		return $this->author_repo->store($data);
	}

	public function update(array $data, int $id) {
		// why would we want to update someone's birthday?!
		return $this->author_repo->update($data, $id);
	}

	public function delete(int $id) {
        $this->author_repo->delete($id);
	}
}