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

}
