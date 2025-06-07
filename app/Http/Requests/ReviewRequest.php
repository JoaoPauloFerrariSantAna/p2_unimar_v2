<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

require_once __DIR__ . "/../../../constants/data_sizes.php";

class ReviewRequest extends FormRequest {
    public function rules(): array {
        return [
			"score" => "required|integer|min:0|max:5",
			"review" => "required|string|min:".FIELD_SIZE_DEFAULT_MIN."|max:".FIELD_SIZE_DESCRIPTION,
        ];
    }
}