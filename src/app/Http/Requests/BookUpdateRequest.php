<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

require_once __DIR__ . "/../../../constants/data_sizes.php";

class BookUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
			"title" => "sometimes|string|min:".FIELD_SIZE_DEFAULT_MIN."|max:".FIELD_SIZE_DEFAULT_MAX,
			"summary" => "sometimes|string|min:".FIELD_SIZE_DEFAULT_MIN."|max:".FIELD_SIZE_DESCRIPTION
        ];
    }
}
