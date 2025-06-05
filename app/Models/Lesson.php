<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'info_lessons';
    protected $primaryKey = 'CodeBL';

    public function Lesson_type()
    {
        return $this->belongsTo(LessonType::class, 'CodeTL');
    }
}
