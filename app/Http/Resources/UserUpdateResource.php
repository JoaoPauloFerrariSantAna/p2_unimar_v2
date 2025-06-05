<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserUpdateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
			"username" => $this->username,
			"email" => $this->email,
			"passwd" => $this->passwd,
			"updated_at" => $this->updated_at
		];
    }
}
