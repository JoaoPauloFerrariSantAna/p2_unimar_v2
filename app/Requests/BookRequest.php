<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function rules()
    {
        return [
            "title" => "required|string|max:32",
            "summary" => "required|string|max:128",
            "ispn" => "required|string|max:13"
        ];
    }
}
