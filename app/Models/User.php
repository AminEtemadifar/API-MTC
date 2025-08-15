<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;

    protected $fillable = [
        'name',
        'username',
        'password',
        'national_code',
        'role_type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function studyField()
    {
        return $this->belongsTo(StudyField::class);
    }

    public function lessons()
    {
        return $this->belongsToMany(Wscrterm::class, 'info_term', 'codeSt', 'codeBL', 'username', 'codeBL');
    }

    public function instructor_lessons()
    {
        return $this->hasMany(Wscrterm::class , 'CodeProf');
    }

    public function isAdmin(): bool
    {
        return $this->role_type === 'instructor';
    }

    public function isSuperAdmin(): bool
    {
        return $this->role_type === 'superadmin';
    }

    public function isStudent(): bool
    {
        return $this->role_type === 'student';
    }

}
