<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewUpdateResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
			"score" => $this->score,
			"review" => $this->review,
			"updated_at" => $this->updated_at
		];
    }
}
