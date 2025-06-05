<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

require_once __DIR__ . "/../../../constants/data_sizes.php";

class AuthorStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "name" => "required|string|min:".FIELD_SIZE_DEFAULT_MIN."|max:".FIELD_SIZE_DEFAULT_MAX,
            "birthday" => [ 
                "required",
                Rule::date()->format("Y-m-d") 
            ],
            "biograph" => "required|string|max:".FIELD_SIZE_DESCRIPTION
        ];
    }
}
