<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewStoreResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
			"score" => $this->score,
			"review" => $this->review
		];
    }
}
