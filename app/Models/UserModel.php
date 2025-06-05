<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model {
    protected $table = "user_tbl";
    protected $fillable = array("username", "email", "passwd");

	public function review() {
		return $this->hasMany(ReviewModel::class);
	}
}
