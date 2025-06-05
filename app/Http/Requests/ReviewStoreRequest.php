<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

require_once __DIR__ . "/../../../constants/data_sizes.php";

class ReviewStoreRequest extends FormRequest {
    public function rules(): array {
        return [
            "review" => "sometimes|string|max:".FIELD_SIZE_DESCRIPTION,
            "score" => "required|integer|min:".FIELD_SIZE_DEFAULT_MIN."|max:".FIELD_SIZE_DEFAULT_SCORE_MAX,
			"user_id" => "required|integer"
        ];
    }
}
