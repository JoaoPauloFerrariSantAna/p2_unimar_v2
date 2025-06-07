<?php

namespace App\Services;

use App\Repositories\GenreRepository;

class GenreService {
    private GenreRepository $genre_repo;

    public function __construct(GenreRepository $genre_repo) {
        $this->genre_repo = $genre_repo;
    }

    public function get() {
        return $this->genre_repo->get();
    }

    public function details(int $id) {
        return $this->genre_repo->details($id);
    }

    public function store(array $data) {
		return $this->genre_repo->store($data);
	}

    public function update(array $data, int $id) {
        return $this->genre_repo->update($data, $id);
	}

    public function delete(int $id) {
        $this->genre_repo->delete($data);
	}
}