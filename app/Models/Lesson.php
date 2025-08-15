<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'info_lessons';
    protected $primaryKey = 'CodeBL';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'CodeBL',
        'CodeTL',
        'Name',
        'UnitT',
        'TheoryTime',
        'UnitP',
        'PracticalTime',
        'CodePL1',
        'CodePL2',
        'CodePL3',
        'CodePL4',
        'status',
    ];

    protected $casts = [
        'UnitT' => 'integer',
        'TheoryTime' => 'integer',
        'UnitP' => 'integer',
        'PracticalTime' => 'integer',
    ];

}
