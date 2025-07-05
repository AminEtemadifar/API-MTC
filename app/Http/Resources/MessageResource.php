<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'message' => $this->message,
            'user' => $this->whenLoaded('writer', function () {
                return UserResource::make($this->writer);
            }),
            'created_at' => Carbon::parse($this->created_at)->toDateTimeString(),
        ];
    }
}
