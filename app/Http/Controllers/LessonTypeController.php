<?php

namespace App\Http\Controllers;

use App\Http\Resources\LessonTypeResource;
use App\Models\LessonType;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Lesson Types",
 *     description="API Endpoints for managing lesson types"
 * )
 */
class LessonTypeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/lesson-types",
     *     tags={"Lesson Types"},
     *     summary="Get all lesson types",
     *     description="Retrieve a list of all lesson types",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of lesson types retrieved successfully",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/LessonTypeResource")
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
        return LessonTypeResource::collection(LessonType::all());
    }

    /**
     * @OA\Post(
     *     path="/lesson-types",
     *     tags={"Lesson Types"},
     *     summary="Create a new lesson type",
     *     description="Create a new lesson type with the provided data",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title"},
     *             @OA\Property(property="title", type="string", example="Practical")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Lesson type created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/LessonTypeResource")
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
     *     path="/lesson-types/{lessonType}",
     *     tags={"Lesson Types"},
     *     summary="Get a specific lesson type",
     *     description="Retrieve details of a specific lesson type",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="lessonType",
     *         in="path",
     *         required=true,
     *         description="Lesson Type ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lesson type details retrieved successfully",
     *         @OA\JsonContent(ref="#/components/schemas/LessonTypeResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Lesson type not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Lesson type not found.")
     *         )
     *     )
     * )
     */
    public function show(LessonType $lessonType)
    {
        //
    }

    /**
     * @OA\Put(
     *     path="/lesson-types/{lessonType}",
     *     tags={"Lesson Types"},
     *     summary="Update a lesson type",
     *     description="Update the details of a specific lesson type",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="lessonType",
     *         in="path",
     *         required=true,
     *         description="Lesson Type ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Advanced Theory")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lesson type updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/LessonTypeResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Lesson type not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Lesson type not found.")
     *         )
     *     )
     * )
     */
    public function update(Request $request, LessonType $lessonType)
    {
        //
    }

    /**
     * @OA\Delete(
     *     path="/lesson-types/{lessonType}",
     *     tags={"Lesson Types"},
     *     summary="Delete a lesson type",
     *     description="Delete a specific lesson type",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="lessonType",
     *         in="path",
     *         required=true,
     *         description="Lesson Type ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lesson type deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Lesson type deleted successfully.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Lesson type not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Lesson type not found.")
     *         )
     *     )
     * )
     */
    public function destroy(LessonType $lessonType)
    {
        //
    }
}
