<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

require_once __DIR__ . "/../../../constants/data_sizes.php";

class GenreStoreRequest extends FormRequest {
    public function rules(): array {
        return [
			"name" => "required|string|min:".FIELD_SIZE_DEFAULT_MIN."|max:".FIELD_SIZE_GENRE_MAX
        ];
    }
}
