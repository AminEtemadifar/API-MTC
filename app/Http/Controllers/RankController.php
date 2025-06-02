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

}
