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
        $user = Auth::guard('web')->loginUsingId(29);
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
            dd($instructorIds);
            $chats = User::whereIn('role_type', ['admin', 'superadmin'])
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
