<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\GenreModel;

class GenreRepository {
	public function get() {
		return response()->json(GenreModel::all());
	}

	public function details(int $id) {
		return GenreModel::findOrFail($id);
	}

	public function store(array $data) {
		$genre = GenreModel::create($data);
		return response()->json($genre);
	}

	public function update(array $data, int $id) {
		$genre = null;
		try {
			$genre = $this->details($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("GENRE NOT FOUND");
		}
        $genre->update($data);
        return response()->json($genre);
	}

	public function delete(int $id) {
		$genre = null;
		try {
			$genre = $this->details($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("GENRE NOT FOUND");
		}
		$genre->delete();
	}
}