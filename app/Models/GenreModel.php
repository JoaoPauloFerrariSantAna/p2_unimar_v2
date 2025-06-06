<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenreModel extends Model
{
    protected $table = "genre_tbl";
    protected $fillable = array("name");

	public function book() {
		return $this->belongsTo(BookModel::class);
	}
}
