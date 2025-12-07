<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'achievement_name',
        'description',
        'levels_needed',
        'days_needed',
        'tasks_needed'
    ];
    public $timestamps = false;

    public function UserAchievement()
    {
        return $this->hasMany(UserAchievement::class);
    }
}
