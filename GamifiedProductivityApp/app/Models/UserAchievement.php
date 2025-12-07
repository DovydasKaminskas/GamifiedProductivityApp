<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAchievement extends Model
{
    protected $fillable = [
        'achievement_id',
        'user_id',
        'level',
        'xp',
        'days',
        'tasks',
        'completed',
        'start_date',
        'updated_at'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'updated_at' => 'datetime'
    ];
    public $timestamps = false;

    public function Achievement() {
        return $this->belongsTo(Achievement::class);
    }
    public function User() {
        return $this->belongsTo(User::class);
    }

    public function getCurrentValueAttribute()
    {
        $userAchievement = $this->achievement;

        if ($userAchievement->xp_needed > 0)    return $this->xp;
        if ($userAchievement->days_needed > 0)  return $this->days;
        if ($userAchievement->tasks_needed > 0) return $this->tasks;
        if ($userAchievement->levels_needed > 0) return $this->level;

        return 0;
    }

    public function getMaxValueAttribute()
    {
        $achievement = $this->achievement;

        if ($achievement->xp_needed > 0)    return $achievement->xp_needed;
        if ($achievement->days_needed > 0)  return $achievement->days_needed;
        if ($achievement->tasks_needed > 0) return $achievement->tasks_needed;
        if ($achievement->levels_needed > 0) return $achievement->levels_needed;

        return 100;
    }

    public function getUnitAttribute()
    {
        $achievement = $this->achievement;

        if ($achievement->xp_needed > 0)    return 'XP';
        if ($achievement->days_needed > 0)  return 'Days';
        if ($achievement->tasks_needed > 0) return 'Tasks';
        if ($achievement->levels_needed > 0) return 'Levels';

        return '';
    }

}
