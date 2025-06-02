<?php

namespace App\Http\Controllers;

use App\Http\Resources\RankResource;
use App\Models\Rank;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Ranks",
 *     description="API Endpoints for managing ranks"
 * )
 */
class RankController extends Controller
{
    /**
     * @OA\Get(
     *     path="/ranks",
     *     tags={"Ranks"},
     *     summary="Get all ranks",
     *     description="Retrieve a list of all ranks",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of ranks retrieved successfully",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/RankResource")
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
        return RankResource::collection(Rank::all());
    }

    /**
     * @OA\Post(
     *     path="/ranks",
     *     tags={"Ranks"},
     *     summary="Create a new rank",
     *     description="Create a new rank with the provided data",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title"},
     *             @OA\Property(property="title", type="string", example="Instructor")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Rank created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/RankResource")
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
     *     path="/ranks/{rank}",
     *     tags={"Ranks"},
     *     summary="Get a specific rank",
     *     description="Retrieve details of a specific rank",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="rank",
     *         in="path",
     *         required=true,
     *         description="Rank ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Rank details retrieved successfully",
     *         @OA\JsonContent(ref="#/components/schemas/RankResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Rank not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Rank not found.")
     *         )
     *     )
     * )
     */
    public function show(Rank $rank)
    {
        //
    }

    /**
     * @OA\Put(
     *     path="/ranks/{rank}",
     *     tags={"Ranks"},
     *     summary="Update a rank",
     *     description="Update the details of a specific rank",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="rank",
     *         in="path",
     *         required=true,
     *         description="Rank ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Senior Instructor")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Rank updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/RankResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Rank not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Rank not found.")
     *         )
     *     )
     * )
     */
    public function update(Request $request, Rank $rank)
    {
        //
    }

    /**
     * @OA\Delete(
     *     path="/ranks/{rank}",
     *     tags={"Ranks"},
     *     summary="Delete a rank",
     *     description="Delete a specific rank",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="rank",
     *         in="path",
     *         required=true,
     *         description="Rank ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Rank deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Rank deleted successfully.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Rank not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Rank not found.")
     *         )
     *     )
     * )
     */
    public function destroy(Rank $rank)
    {
        //
    }
}
