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
     * Display a listing of the resource.
     */
    public function index()
    {
        var_dump(Auth::guard('web')->user());
        var_dump(Auth::check('web'));

        die();
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
