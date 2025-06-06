<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserStoreResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
			"username" => $this->username,
			"email" => $this->email,
			"passwd" => $this->passwd
		];
    }
}
