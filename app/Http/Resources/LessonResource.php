<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="LessonResource",
 *     title="Lesson Resource",
 *     description="Lesson resource schema",
 *     @OA\Property(property="id", type="integer", example=1, description="Lesson code"),
 *     @OA\Property(
 *         property="lesson_type",
 *         ref="#/components/schemas/LessonTypeResource",
 *         description="Associated lesson type"
 *     ),
 *     @OA\Property(property="title", type="string", example="Mathematics", description="Lesson name"),
 *     @OA\Property(property="theory_unit", type="integer", example=2, description="Theory unit count"),
 *     @OA\Property(property="theory_time", type="integer", example=45, description="Theory time in minutes"),
 *     @OA\Property(property="practical_unit", type="integer", example=1, description="Practical unit count"),
 *     @OA\Property(property="practical_time", type="integer", example=30, description="Practical time in minutes"),
 *     @OA\Property(property="status", type="boolean", example=true, description="Lesson status")
 * )
 */
class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->CodeBL,
            'lesson_type' => LessonTypeResource::make($this->Lesson_type),
            'title' => $this->Name,
            'theory_unit' => $this->UnitT,
            'theory_time' => $this->TheoryTime,
            'practical_unit' => $this->UnitP,
            'practical_time' => $this->PracticalTime,
            //'' => $this->CodePL1,
            //'' => $this->CodePL2,
            //'' => $this->CodePL3,
            //'' => $this->CodePL4,
            'status' => $this->status,
        ];
    }
}
