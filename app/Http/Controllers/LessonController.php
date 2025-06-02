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

    /**
     * @OA\Post(
     *     path="/lessons",
     *     tags={"Lessons"},
     *     summary="Create a new lesson",
     *     description="Create a new lesson with the provided data",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "lesson_type_id"},
     *             @OA\Property(property="title", type="string", example="Physics"),
     *             @OA\Property(property="lesson_type_id", type="integer", example=1),
     *             @OA\Property(property="theory_unit", type="integer", example=2),
     *             @OA\Property(property="theory_time", type="integer", example=45),
     *             @OA\Property(property="practical_unit", type="integer", example=1),
     *             @OA\Property(property="practical_time", type="integer", example=30)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Lesson created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/LessonResource")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object"
     *             )
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/lessons/{lesson}",
     *     tags={"Lessons"},
     *     summary="Get a specific lesson",
     *     description="Retrieve details of a specific lesson",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="lesson",
     *         in="path",
     *         required=true,
     *         description="Lesson ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lesson details retrieved successfully",
     *         @OA\JsonContent(ref="#/components/schemas/LessonResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Lesson not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Lesson not found.")
     *         )
     *     )
     * )
     */
    public function show(Lesson $lesson)
    {
        //
    }

    /**
     * @OA\Put(
     *     path="/lessons/{lesson}",
     *     tags={"Lessons"},
     *     summary="Update a lesson",
     *     description="Update the details of a specific lesson",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="lesson",
     *         in="path",
     *         required=true,
     *         description="Lesson ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Advanced Physics"),
     *             @OA\Property(property="lesson_type_id", type="integer", example=1),
     *             @OA\Property(property="theory_unit", type="integer", example=3),
     *             @OA\Property(property="theory_time", type="integer", example=60),
     *             @OA\Property(property="practical_unit", type="integer", example=2),
     *             @OA\Property(property="practical_time", type="integer", example=45)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lesson updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/LessonResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Lesson not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Lesson not found.")
     *         )
     *     )
     * )
     */
    public function update(Request $request, Lesson $lesson)
    {
        //
    }

    /**
     * @OA\Delete(
     *     path="/lessons/{lesson}",
     *     tags={"Lessons"},
     *     summary="Delete a lesson",
     *     description="Delete a specific lesson",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="lesson",
     *         in="path",
     *         required=true,
     *         description="Lesson ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lesson deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Lesson deleted successfully.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Lesson not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Lesson not found.")
     *         )
     *     )
     * )
     */
    public function destroy(Lesson $lesson)
    {
        //
    }
}
