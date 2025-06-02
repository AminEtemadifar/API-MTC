<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="BranchResource",
 *     title="Branch Resource",
 *     description="Branch resource schema",
 *     @OA\Property(property="id", type="integer", example=1, description="Branch code"),
 *     @OA\Property(property="title", type="string", example="Main Branch", description="Branch name"),
 *     @OA\Property(
 *         property="rank_id",
 *         ref="#/components/schemas/RankResource",
 *         description="Associated rank"
 *     ),
 *     @OA\Property(property="color_name", type="string", example="Blue", description="Branch color name"),
 *     @OA\Property(property="group_id", type="integer", example=1, description="Group code"),
 *     @OA\Property(property="image_url", type="string", example="https://example.com/image.jpg", description="Education chart image URL"),
 *     @OA\Property(property="status", type="boolean", example=true, description="Branch status")
 * )
 */
class BranchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->CodeBrc,
            'title' => $this->NameBrc,
            'rank_id' => RankResource::make($this->rank),
            'color_name' => $this->NameColor,
            'group_id' => $this->CodeGroup,
            'image_url' => $this->EducationChartImage,
            'status' => $this->status,
        ];
    }
}
