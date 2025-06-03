<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

require_once __DIR__ . "/../../../constants/data_sizes.php";

class GenreUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
			"name" => "sometimes|string|min:".FIELD_SIZE_DEFAULT_MIN."|max:".FIELD_SIZE_GENRE_NAME_MAX
        ];
    }
}
