<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudyField extends Model
{
    protected $fillable = [
        'title',
        'description',
        'download_link',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function charts(): HasMany
    {
        return $this->hasMany(Chart::class);
    }
}
