<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

require_once __DIR__ . "/../../../constants/data_sizes.php";

class UserStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
			"username" => "required|string|min:".FIELD_SIZE_DEFAULT_MIN."|max:".FIELD_SIZE_DEFAULT_MAX,
			"email" => "required|string|min:".FIELD_SIZE_DEFAULT_MIN."|max:".FIELD_SIZE_DEFAULT_MAX,
			"passwd" => "required|string|min:".FIELD_SIZE_PASSWD_MIN."|max:".FIELD_SIZE_PASSWD_MAX
        ];
    }
}
