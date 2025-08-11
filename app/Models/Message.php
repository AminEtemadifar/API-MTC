<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Message extends Model
{
    public $fillable = [
        "message",
        "user_id",
        "writer_id",
        "created_at",
    ];

    public function writer(): BelongsTo
    {
        return $this->belongsTo(User::class , 'writer_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class , 'user_id');
    }
}
