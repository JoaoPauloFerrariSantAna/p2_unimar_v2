<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

require_once __DIR__ . "/../../../constants/data_sizes.php";

class BookStoreRequest extends FormRequest {
    public function rules(): array {
        return [
            "title" => "required|string|min:".FIELD_SIZE_DEFAULT_MIN."|max:".FIELD_SIZE_DEFAULT_MAX,
			"summary" => "required|string|min:".FIELD_SIZE_DEFAULT_MIN."|max:".FIELD_SIZE_DESCRIPTION,
			"author_id" => "required|integer",
			"genre_id" => "required|integer",
			"review_id" =>"required|integer"
        ];
    }
}
