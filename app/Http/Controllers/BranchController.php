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

    /**
     * @OA\Post(
     *     path="/branches",
     *     tags={"Branches"},
     *     summary="Create a new branch",
     *     description="Create a new branch with the provided data",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "rank_id"},
     *             @OA\Property(property="title", type="string", example="New Branch"),
     *             @OA\Property(property="rank_id", type="integer", example=1),
     *             @OA\Property(property="color_name", type="string", example="Blue"),
     *             @OA\Property(property="group_id", type="integer", example=1),
     *             @OA\Property(property="image_url", type="string", example="https://example.com/image.jpg")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Branch created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/BranchResource")
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
     *     path="/branches/{branch}",
     *     tags={"Branches"},
     *     summary="Get a specific branch",
     *     description="Retrieve details of a specific branch",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="branch",
     *         in="path",
     *         required=true,
     *         description="Branch ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Branch details retrieved successfully",
     *         @OA\JsonContent(ref="#/components/schemas/BranchResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Branch not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Branch not found.")
     *         )
     *     )
     * )
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * @OA\Put(
     *     path="/branches/{branch}",
     *     tags={"Branches"},
     *     summary="Update a branch",
     *     description="Update the details of a specific branch",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="branch",
     *         in="path",
     *         required=true,
     *         description="Branch ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Updated Branch Name"),
     *             @OA\Property(property="rank_id", type="integer", example=1),
     *             @OA\Property(property="color_name", type="string", example="Red"),
     *             @OA\Property(property="group_id", type="integer", example=2),
     *             @OA\Property(property="image_url", type="string", example="https://example.com/new-image.jpg")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Branch updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/BranchResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Branch not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Branch not found.")
     *         )
     *     )
     * )
     */
    public function update(Request $request, Branch $branch)
    {
        //
    }

    /**
     * @OA\Delete(
     *     path="/branches/{branch}",
     *     tags={"Branches"},
     *     summary="Delete a branch",
     *     description="Delete a specific branch",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="branch",
     *         in="path",
     *         required=true,
     *         description="Branch ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Branch deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Branch deleted successfully.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Branch not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Branch not found.")
     *         )
     *     )
     * )
     */
    public function destroy(Branch $branch)
    {
        //
    }
}
