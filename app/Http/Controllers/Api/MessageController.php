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
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $auth = Auth::guard('web')->loginUsingId(29);
        $validated = $request->validate([
            'user_id' => 'required|integer',
        ]);

        $messages = Message::query()
            ->whereIn('user_id', [$validated['user_id'], "$auth->id"])
            ->orderBy('created_at', 'desc')
            ->get();

        return MessageResource::collection($messages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

}
