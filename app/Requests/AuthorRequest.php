<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuthorRequest extends FormRequest
{
    public function rules()
    {
        return [
            "name" => "required|string|max:32",
            "birthday" => [ "required", Rule::date()->format("Y-m-d") ],
            "biograph" => "required|string|max:128"
        ];
    }
}
