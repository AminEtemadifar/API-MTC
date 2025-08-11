<?php

namespace App\Models;

use App\Enums\DegreeLevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chart extends Model
{
    protected $fillable = [
        'title',
        'sub_title',
        'download_link',
        'study_field_id',
        'degree_level',
    ];

    protected $casts = [
        'degree_level' => DegreeLevel::class,
        'download_link' => "string",
    ];

    public function studyField(): BelongsTo
    {
        return $this->belongsTo(StudyField::class);
    }
}
