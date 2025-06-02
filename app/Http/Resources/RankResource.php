<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="RankResource",
 *     title="Rank Resource",
 *     description="Rank resource schema",
 *     @OA\Property(property="id", type="integer", example=1, description="Rank code"),
 *     @OA\Property(property="title", type="string", example="Beginner", description="Rank name"),
 *     @OA\Property(property="status", type="boolean", example=true, description="Rank status")
 * )
 */
class RankResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->CodeRnk,
            'title' => $this->NameRnk,
            'status' => $this->status,
        ];
    }
}
