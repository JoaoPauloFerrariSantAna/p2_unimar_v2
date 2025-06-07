<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Http\Requests\ListingRequest;

use App\Services\BookService;

class BookController extends Controller {
	private BookService $bservice;

	public function __construct(BookService $bservice) {
		$this->bservice = $bservice;
	}

	public function getBooks() {
		return response()->json($this->bservice->get());
	}

	public function getBooksReview(ListingRequest $req) {
		$data = $req->validated();
		$review_id = $data["idToUse"];
		return response()->json($this->bservice->getBooksReview($review_id));
	}

	public function getBookByGenre(ListingRequest $req) {
		$data = $req->validated();
		$genre_id = $data["idToUse"];
		return response()->json($this->bservice->getBookByGenre($genre_id));
	}

	// we are using authorId here because it makes sense
	// who created the book was the author, so the author is unique in relation to a book
	public function getBookGeneralInfomation(ListingRequest $req) {
		$data = $req->validated();
		$author_id = $data["idToUse"];
		return response()->json($this->bservice->getBookGeneralInfomation($author_id));
	}

	public function detailBook(ListingRequest $req) {
		$data = $req->validated();
		$id = $data["idToUse"];
		return response()->json($this->bservice->details($id));
	}

	public function storeBook(BookStoreRequest $req) {
		$data = $req->validated();
		return response()->json($this->bservice->store($data));
	}

	public function updateBook(BookUpdateRequest $req_book, ListingRequest $req_id) {
		$data_book = $req_book->validated();
		$data_id = $req_id->validated();
		$id = $data_id["idToUse"];
		return response()->json($this->bservice->update($id));
	}

	public function deleteBook(ListingRequest $req) {
		$data = $req->validated();
		$id = $data["idToUse"];
		$this->bservice->delete($id);
	}
}
