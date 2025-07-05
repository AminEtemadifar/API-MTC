<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="MessageResource",
     *     type="object",
     *     title="Message Resource",
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(property="message", type="string", example="Hello, how are you?"),
     *     @OA\Property(
     *         property="user",
     *         ref="#/components/schemas/UserResource"
     *     ),
     *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-06-01 12:34:56")
     * )
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
