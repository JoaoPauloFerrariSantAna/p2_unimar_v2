<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

require_once __DIR__ . "/../../../constants/data_sizes.php";

class AuthorUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "name" => "sometimes|string|min:".FIELD_SIZE_DEFAULT_MIN."|max:".FIELD_SIZE_DEFAULT_MAX,
            "birthday" => [ 
                "sometimes",
                Rule::date()->format("Y-m-d") 
            ],
            "biograph" => "sometimes|string|max:".FIELD_SIZE_DESCRIPTION
        ];
    }
}
