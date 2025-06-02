<?php

namespace App\Http\Controllers;

use App\Http\Resources\BranchResource;
use App\Models\Branch;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Tag(
 *     name="Branches",
 *     description="API Endpoints for managing branches"
 * )
 */
class BranchController extends Controller
{
    /**
     * @OA\Get(
     *     path="/branches",
     *     tags={"Branches"},
     *     summary="Get all branches",
     *     description="Retrieve a list of all branches, optionally filtered by rank",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="rank_id",
     *         in="query",
     *         description="Filter branches by rank ID",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of branches retrieved successfully",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/BranchResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="object")
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
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rank_id' => 'nullable|exist:info_rank,CodeRnk',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $branches = Branch::query()->when(
            $request->has('rank_id'),
            function (Builder $builder) use ($request) {
                $builder->where('CodeRnk', $request->rank_id);
            })->get();

        return BranchResource::collection($branches);
    }

}
