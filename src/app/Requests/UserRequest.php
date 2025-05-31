<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules()
    {
        return [
            "username" => "required|string|max:32",
            "email" => "required|string|max:32",
            "passwd" => "required|string|max:16"
        ];
    }
}
