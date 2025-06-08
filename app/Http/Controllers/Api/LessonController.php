<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Lessons",
 *     description="API Endpoints for lessons management"
 * )
 */
class LessonController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/lessons",
     *     tags={"Lessons"},
     *     summary="Get list of lessons",
     *     @OA\Response(
     *         response=200,
     *         description="List of lessons",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/LessonResource")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $lessons = Lesson::with(['instructor', 'students'])->get();
        return LessonResource::collection($lessons);
    }
}
