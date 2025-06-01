<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\BookModel;

class BookController extends Controller {
	public function getBooks() {
		return response()->json(BookModel::all());
	}

	public function detailBook(int $id) {
		$book = null;
		try {
			$book = BookModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("BOOK NOT FOUND");
		}
		return response()->json($book);
	}

	public function storeBook(BookStoreRequest $req) {
		$data = $req->validated();
		$book = BookModel::create($data);
		return response()->json($book);
	}

	public function updateBook(BookUpdateRequest $req, int $id) {
		$data = $req->validated();
		$book = null;
		try {
			$book = BookModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("BOOK NOT FOUND");
		}
		$book->update($data);
		return response()->json($book);
	}

	public function deleteBook(int $id) {
		$book = null;
		try {
			$book = BookModel::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return response()->json("BOOK NOT FOUND");
		}
		$book->delete();
		return response()->json($book);
	}
}
