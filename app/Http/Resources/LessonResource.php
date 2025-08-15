<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="LessonResource",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="code", type="string", example="CS101"),
 *     @OA\Property(property="course_offering_code", type="string", example="CS101-2024"),
 *     @OA\Property(property="title", type="string", example="Introduction to Programming"),
 *     @OA\Property(property="offering_day", type="string", example="Monday"),
 *     @OA\Property(property="offering_time", type="string", example="08:00-10:00"),
 *     @OA\Property(property="classroom_number", type="string", example="101"),
 *     @OA\Property(property="exam_date", type="string", format="date", example="2024-06-15"),
 *     @OA\Property(
 *         property="instructor",
 *         type="object",
 *         nullable=true,
 *         ref="#/components/schemas/UserResource"
 *     ),
 *     @OA\Property(property="students_count", type="integer", example=30),
 *     @OA\Property(
 *         property="students",
 *         type="array",
 *         nullable=true,
 *         @OA\Items(ref="#/components/schemas/UserResource")
 *     )
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
            'id' => $this->CodeTGL,
            'code' => $this->lesson->CodeBL,
            'course_offering_code' => $this->CodeTGL,
            'title' => $this->lesson->Name,
            'offering_day' => $this->day_name,
            'offering_time' => $this->day_time,
            'classroom_number' => $this->CodeClass,
            'exam_date' => $this->DateExam,
            'instructor' => new UserResource($this->whenLoaded('instructor')),
            'students_count' => $this->whenCounted('students'),
            'students' => UserResource::collection($this->whenLoaded('students')),
            ];
    }
}
