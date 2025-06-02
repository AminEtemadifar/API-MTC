<?php

namespace App\Http\Controllers;

use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Lessons",
 *     description="API Endpoints for managing lessons"
 * )
 */
class LessonController extends Controller
{
    /**
     * @OA\Get(
     *     path="/lessons",
     *     tags={"Lessons"},
     *     summary="Get all lessons",
     *     description="Retrieve a list of all lessons",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of lessons retrieved successfully",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/LessonResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $lessons = Lesson::all();
        return LessonResource::collection($lessons);
    }

}
