<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorModel extends Model
{
    protected $table = "author_tbl";
    protected $fillable = array("name", "birthday", "biograph");
}