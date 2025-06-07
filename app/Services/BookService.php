<?php
namespace App\Services;

use App\Repositories\BookRepository;

class BookService {
    private BookRepository $book_repo;

    public function __construct(BookRepository $book_repo) {
        $this->book_repo = $book_repo;
    }

	public function get() {
		return $this->book_repo->get();
	}

	public function getBooksReview(int $review_id) {
		return $this->book_repo->getBooksReview($review_id);
	}

	public function getBookByGenre(int $genre_id) {
		return $this->book_repo->getBookByGenre($genre_id);
	}

	// we are using authorId here because it makes sense
	// who created the book was the author, so the author is unique in relation to a book
	public function getBookGeneralInfomation(int $author_id) {
		return $this->book_repo->getBookGeneralInfomation($author_id);
	}

	public function details(int $id) {
		return $this->book_repo->details($id);
	}

	public function store(array $data) {
        return $this->book_repo->storeBook($data);
	}

	public function update(array $data, int $id) {
		return response()->json($book);
	}

	public function delete(array $data, int $id) {
		$this->urepo->delete($id);
	}
}