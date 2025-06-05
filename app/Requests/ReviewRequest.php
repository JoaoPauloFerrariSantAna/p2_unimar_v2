<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    public function rules()
    {
        return [
            "review" => "required|string|max:128",
            "score" => "required|integer|min:0|max:5"
        ];
    }
}