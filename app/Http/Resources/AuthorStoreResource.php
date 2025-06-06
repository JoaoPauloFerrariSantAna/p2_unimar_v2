<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Requests\AuthorStoreRequest;

class AuthorStoreResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
			"name" => $this->name,
			"biograph" => $this->biograph
		];
    }
}
