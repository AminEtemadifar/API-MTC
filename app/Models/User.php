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
        'study_field_id',
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
        return $this->belongsToMany(Lesson::class);
    }

    public function isAdmin(): bool
    {
        return $this->role_type === 'admin';
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
