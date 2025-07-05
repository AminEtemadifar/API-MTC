<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Message extends Model
{
    public $fillable = [
        "message",
        "user_id",
    ];

    public function writer(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
