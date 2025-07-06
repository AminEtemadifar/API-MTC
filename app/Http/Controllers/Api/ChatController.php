<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Get chat list for authenticated user.
     *
     * @OA\Get(
     *     path="/api/chats",
     *     tags={"Chats"},
     *     summary="List chat users based on role",
     *     description="Returns a list of users the authenticated user can chat with. Admins see students of their lessons, students see their instructors, superadmins see both.",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful list",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/UserResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function index()
    {
        $user = Auth::guard('sanctum')->user();
        if ($user->isAdmin()) {
            $lessonIds = $user->instructor_lessons()->pluck('id');
            $chats = User::where('role_type', 'student')
                ->whereHas('lessons', function (Builder $query) use ($lessonIds) {
                    $query->whereIn('lessons.id', $lessonIds);
                })
                ->get();
        } elseif ($user->isStudent()) {
            // Students see their instructors
            $instructorIds = $user->lessons()->pluck('instructor_id')->unique();
            $chats = User::whereIn('role_type', ['instructor', 'superadmin'])
                ->whereIn('id', $instructorIds)
                ->get();
        }else{
            $chats = User::query()
                ->whereIn('role_type', ['superadmin', 'student'])
                ->get();
        }

        return UserResource::collection($chats);
    }

}
