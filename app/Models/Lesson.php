<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lesson extends Model
{

    protected $fillable = [
        'code',
        'course_offering_code',
        'title',
        'offering_day',
        'offering_time',
        'classroom_number',
        'instructor_id',
        'exam_date',
    ];

    protected $casts = [
        'exam_date' => 'date',
    ];

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
