<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookModel extends Model
{
    protected $table = "book_tbl";
    protected $fillable = array("title", "summary", "genre_id", "author_id", "review_id");

	public function genre() {
		return $this->hasMany(GenreModels::class);
	}
}
