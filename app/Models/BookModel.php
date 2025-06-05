<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookModel extends Model
{
    protected $table = "book_tbl";
    protected $fillable = array("title", "summary", "ispn");
}
