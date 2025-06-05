<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewModel extends Model {
    protected $table = "review_tbl";
    protected $fillable = array("score", "review", "user_id", "genre_id");

	public function user() {
		return $this->belongsTo(UserModel::class);
	}
}
