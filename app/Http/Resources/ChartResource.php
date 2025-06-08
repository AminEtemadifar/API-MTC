<?php

namespace App\Http\Resources;

use App\Enums\DegreeLevel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="ChartResource",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Computer Science Curriculum"),
 *     @OA\Property(property="sub_title", type="string", example="Bachelor's Degree Program"),
 *     @OA\Property(property="download_link", type="string", example="https://example.com/charts/cs-bachelor.pdf"),
 *     @OA\Property(property="degree_level", type="string", example="Bachelor", description="Associate, Bachelor, Master, PhD"),
 *     @OA\Property(
 *         property="study_field",
 *         type="object",
 *         nullable=true,
 *         @OA\Property(property="id", type="integer", example=1),
 *         @OA\Property(property="title", type="string", example="Computer Science")
 *     )
 * )
 */
class ChartResource extends JsonResource
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
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'download_link' => $this->download_link,
            'degree_level' => DegreeLevel::fromLabel($this->degree_level),
            'study_field' => StudyFieldResource::make($this->whenLoaded('studyField')),
        ];
    }
}
