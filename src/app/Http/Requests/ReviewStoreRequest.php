<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewStoreRequest extends FormRequest {
    public function rules(): array {
        return [
            "review" => "sometimes|string|max:".FIELD_SIZE_DESCRIPTION,
            "score" => "sometimes|integer|min:".FIELD_SIZE_DEFAULT_SCORE_MIN."|max:".FIELD_SIZE_DEFAULT_SCORE_MAX
        ];
    }
}
