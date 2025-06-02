<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $primaryKey = 'Stno';
    protected $table = 'student';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'Stno',
        'FnameSt',
        'CodeRnk',
        'LnameSt',
        'CodeMelliSt',
        'CodeBrc',
        'UserName',
        'Pass',
        'CodeAccess',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'Pass',
    ];
}
