<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="News",
 *     description="API Endpoints for news management"
 * )
 */
class NewsController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/news",
     *     tags={"News"},
     *     summary="Get list of all news",
     *     @OA\Parameter(
     *         name="expire_at",
     *         in="query",
     *         required=false,
     *         description="Filter news by expiration date (Y-m-d H:i:s)",
     *         @OA\Schema(type="string", format="date-time", example="2024-12-31 23:59:59")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of news",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/NewsResource")
     *             )
     *         )
     *     )
     * )
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'expire_at' => 'nullable|date',
        ]);
        $news = News::query()->when(!empty($validated), function ($q) use ($validated) {
            return $q->where('expire_at', ">=",  Carbon::parse($validated['expire_at'])->toDateString());
        })->latest()->get();
        return NewsResource::collection($news);
    }

    /**
     * @OA\Post(
     *     path="/api/news",
     *     tags={"News"},
     *     summary="Create a new news item",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title","description"},
     *             @OA\Property(property="title", type="string", example="New Announcement"),
     *             @OA\Property(property="description", type="string", example="This is a new announcement"),
     *             @OA\Property(property="link", type="string", nullable=true, example="https://example.com/news/2"),
     *             @OA\Property(property="expire_at", type="string", format="date-time", nullable=true, example="2024-12-30 23:59:59")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="News created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/NewsResource")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized - Superadmin only"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $this->authorize('create', News::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|url',
            'expire_at' => 'nullable|date',
        ]);

        $news = News::create($validated);

        return NewsResource::make($news);
    }

    /**
     * @OA\Get(
     *     path="/api/news/{id}",
     *     tags={"News"},
     *     summary="Get a specific news item",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="News ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="News details",
     *         @OA\JsonContent(ref="#/components/schemas/NewsResource")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized - Superadmin only"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="News not found"
     *     )
     * )
     */
    public function show(News $news)
    {
        return NewsResource::make($news);
    }

    /**
     * @OA\Put(
     *     path="/api/news/{id}",
     *     tags={"News"},
     *     summary="Update a news item",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="News ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title","description"},
     *             @OA\Property(property="title", type="string", example="Updated Announcement"),
     *             @OA\Property(property="description", type="string", example="This is an updated announcement"),
     *             @OA\Property(property="link", type="string", nullable=true, example="https://example.com/news/1"),
     *             @OA\Property(property="expire_at", type="string", format="date-time", nullable=true, example="2024-12-31 23:59:59")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="News updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/NewsResource")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized - Superadmin only"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="News not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function update(Request $request, News $news)
    {
        $this->authorize('update', $news);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|url',
            'expire_at' => 'nullable|date',
        ]);

        $news->update($validated);

        return NewsResource::make($news);
    }

    /**
     * @OA\Delete(
     *     path="/api/news/{id}",
     *     tags={"News"},
     *     summary="Delete a news item",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="News ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="News deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized - Superadmin only"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="News not found"
     *     )
     * )
     */
    public function destroy(News $news)
    {
        $this->authorize('delete', $news);
        $news->delete();
        return response()->json(null, 204);
    }
}
