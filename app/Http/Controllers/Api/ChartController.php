<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChartCollection;
use App\Http\Resources\ChartResource;
use App\Models\Chart;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Charts",
 *     description="API Endpoints for charts management"
 * )
 */
class ChartController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/charts",
     *     tags={"Charts"},
     *     summary="Get list of charts with optional degree level filter",
     *     @OA\Parameter(
     *         name="degree_level",
     *         in="query",
     *         description="Filter by degree level (1: Associate, 2: Bachelor, 3: Master, 4: PhD)",
     *         required=false,
     *         @OA\Schema(type="integer", enum={1,2,3,4})
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of charts",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/ChartResource")
     *             )
     *         )
     *     )
     * )
     */
    public function index(Request $request)
    {
        $query = Chart::query()->with('studyField');

        if ($request->has('degree_level')) {
            $query->where('degree_level', $request->degree_level);
        }

        $charts = $query->get();
        return ChartResource::collection($charts);
    }
}
