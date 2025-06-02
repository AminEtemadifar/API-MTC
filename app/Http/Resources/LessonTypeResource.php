<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="LessonTypeResource",
 *     title="Lesson Type Resource",
 *     description="Lesson type resource schema",
 *     @OA\Property(property="id", type="integer", example=1, description="Lesson type code"),
 *     @OA\Property(property="title", type="string", example="Theory", description="Lesson type name"),
 *     @OA\Property(property="status", type="boolean", example=true, description="Lesson type status")
 * )
 */
class LessonTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->CodeTL,
            'title' => $this->NameTL,
            'status' => $this->status,
        ];
    }
}
