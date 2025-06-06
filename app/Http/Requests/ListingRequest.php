<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

require_once __DIR__ . "/../../../constants/data_sizes.php";

// 'cause we are querying (listing) information
// so this is more generic to pass the ids around
class ListingRequest extends FormRequest {
    public function rules(): array
    {
        return [
			"idToUse" => "required|integer|min:".FIELD_SIZE_DEFAULT_MIN
        ];
    }
}
