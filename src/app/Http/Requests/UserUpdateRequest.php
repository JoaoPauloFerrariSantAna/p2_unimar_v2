<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

require_once __DIR__ . "/../../../constants/data_sizes.php";

class UserUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "username" => "sometimes|string|min:".FIELD_SIZE_DEFAULT_MIN."|max:".FIELD_SIZE_DEFAULT_MAX,
            "email" => "sometimes|string|min:".FIELD_SIZE_DEFAULT_MIN."|max:".FIELD_SIZE_DEFAULT_MAX,
            "passwd" => "sometimes|string|min:".FIELD_SIZE_PASSWD_MIN."|max:".FIELD_SIZE_PASSWD_MAX
        ];
    }
}
