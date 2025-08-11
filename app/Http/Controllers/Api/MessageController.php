<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of messages between the authenticated user and another user.
     *
     * @OA\Get(
     *     path="/api/messages",
     *     summary="List messages with another user",
     *     tags={"Messages"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         required=true,
     *         description="ID of the user to fetch chat messages with",
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="List of messages",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/MessageResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $auth = Auth::user();
        $validated = $request->validate([
            'user_id' => 'required|integer',
        ]);

        $messages = Message::query()
            ->with("writer")
            ->whereIn('user_id', [$validated['user_id'], "$auth->id"])
            ->whereIn('writer_id', [$validated['user_id'], "$auth->id"])
            ->orderBy('created_at', 'desc')
            ->get();

        return MessageResource::collection($messages);
    }

    /**
     * Store a new message.
     *
     * @OA\Post(
     *     path="/api/messages",
     *     summary="Send a message",
     *     tags={"Messages"},
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"message", "user_id"},
     *             @OA\Property(property="message", type="string", example="Hello!"),
     *             @OA\Property(property="user_id", type="integer", example=2)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Message sent",
     *         @OA\JsonContent(ref="#/components/schemas/MessageResource")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
            'user_id' => 'required',

        ]);
        $validated['writer_id'] = Auth::id();
        $message = Message::create($validated);

        return MessageResource::make($message);
    }

}
