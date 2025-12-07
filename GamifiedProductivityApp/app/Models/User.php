<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Mehradsadeghi\FilterQueryString\FilterQueryString;

class User extends Authenticatable
{
    use HasFactory, Notifiable, FilterQueryString;

    protected $fillable = [
        'username',
        'email',
        'password',
        'last_login',
        'day_streak',
        'timezone',
        'xp',
        'tasks_completed',
        'xp_today',
        'tasks_completed_today',
    ];
    protected $filters = [
        'sort',
        'in',
        'like'
    ];
    protected $casts = [
        'last_login' => 'datetime',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function Tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function UserAchievements()
    {
        return $this->hasMany(UserAchievement::class);
    }

}
