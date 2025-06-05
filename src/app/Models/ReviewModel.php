<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewModel extends Model
{
    protected $table = "review_tbl";
    protected $fillable = array("score", "review");
}
