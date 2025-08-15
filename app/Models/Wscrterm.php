<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Wscrterm extends Model
{
    protected $table = 'wscrterm';
    protected $primaryKey = 'id';

    protected $fillable = [
        'CodeTGL',
        'CodeBL',
        'CodeDay',
        'TimeStart',
        'TimeEnd',
        'CodeClass',
        'CodeProf',
        'MaxCapacity',
        'DateExam',
        'Status',
    ];

    protected $casts = [
        'MaxCapacity' => 'integer',
        'DateExam' => 'date',
    ];

    /**
     * Get the day name
     */
    public function getDayNameAttribute(): string
    {
        $days = [
            '1' => 'شنبه',
            '2' => 'یکشنبه',
            '3' => 'دوشنبه',
            '4' => 'سه‌شنبه',
            '5' => 'چهارشنبه',
            '6' => 'پنج‌شنبه',
            '7' => 'جمعه',
        ];

        return $days[$this->CodeDay] ?? 'نامشخص';
    }

    /**
     * Get the time name
     */
    public function getDayTimeAttribute(): string
    {
        return $this->TimeStart . ' تا  ' . $this->TimeEnd;
    }

    /**
     * Get the lesson this schedule belongs to
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(InfoLesson::class, 'CodeBL', 'CodeBL');
    }

    /**
     * Get the instructor (professor)
     */
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'CodeProf', 'national_code');
    }

    /**
     * Get the students enrolled in this lesson
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'info_term', 'codeBL', 'codeSt', 'CodeBL', 'username');
    }
}
