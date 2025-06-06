<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorUpdateResource extends JsonResource {
    public function toArray(Request $request): array {
		// who cares about the birthday?
        return [
			"name" => $this->name,
			"biograph" => $this->biograph,
			"updated_at" => $this->updated_at
		];
    }
}
