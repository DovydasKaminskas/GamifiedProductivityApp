<?php

namespace App\Services;


use App\Models\User;
use App\Models\Achievement;
use App\Models\UserAchievement;

class AchievementService
{
    protected $loginStreakService;

    public function __construct(TodaysProgressService $loginStreakService) {
        $this->loginStreakService = $loginStreakService;
    }

    public function createAchievementsForUsers(User $user) {
        $achievements = Achievement::all();
        foreach ($achievements as $achievement) {
            $userAchievement = UserAchievement::create([
                'achievement_id' => $achievement->id,
                'user_id' => $user->id,
                'level' => 0,
                'xp' => 0,
                'days' => 0,
                'tasks' => 0,
                'completed' => false
            ]);
            $userAchievement->save();
        }
    }
    public function alwaysOn(User $user) {
        $achievement = Achievement::where('achievement_name', 'Always On')->first();
        $userAchievement = UserAchievement::where('achievement_id', $achievement->id)->where('user_id', $user->id)->first();
        if (!$userAchievement->completed) {
            $userAchievement->days = $user->day_streak;
            if ($userAchievement->days == $achievement->days_needed) {
                $userAchievement->completed = 1;
                $user->achievements_earned++;
            }
        }
        $userAchievement->save();
    }

    public function taskCrusher(User $user) {
        $achievement = Achievement::where('achievement_name', 'Task Crusher')->first();
        $userAchievement = UserAchievement::where('achievement_id', $achievement->id)->where('user_id', $user->id)->first();
        if (!$userAchievement->completed) {
            $userAchievement->tasks++;
            if ($userAchievement->tasks ==  $achievement->tasks_needed) {
                $userAchievement->completed = 1;
                $user->achievements_earned++;
            }
        }
        $userAchievement->save();
    }

    public function consistencyIsKey(User $user) {
        $achievement = Achievement::where('achievement_name', 'Consistency is Key')->first();
        $userAchievement = UserAchievement::where('achievement_id', $achievement->id)->where('user_id', $user->id)->first();
        if (!$userAchievement->completed) {
            if ($userAchievement->updated_at == NULL) {
                $userAchievement->updated_at = now();
                $userAchievement->days = 1;
            }
            else if ($userAchievement->updated_at->isYesterday()) {
                $userAchievement->days++;
                if($userAchievement->days >= $achievement->days_needed) {
                    $userAchievement->completed = 1;
                    $user->achievements_earned++;
                }
            }
            else if (!$userAchievement->updated_at->isToday()) { // Every other day besides today and yesterday
                $userAchievement->days = 1;
            }
            $userAchievement->updated_at = now();
        }
        $userAchievement->save();
    }

    public function xpHunter(User $user, int $progress) {
        $achievement = Achievement::where('achievement_name', 'XP Hunter')->first();
        $userAchievement = UserAchievement::where('achievement_id', $achievement->id)->where('user_id', $user->id)->first();
        if (!$userAchievement->completed) {
            $userAchievement->xp += $progress;
            if ($userAchievement->xp >=  $achievement->xp_needed) {
                $userAchievement->completed = 1;
                $userAchievement->xp = $achievement->xp_needed;
                $user->achievements_earned++;
            }
        }
        $userAchievement->save();
    }
    public function whatIsRest(User $user, int $progress) {
        $achievement = Achievement::where('achievement_name', 'What is Rest?')->first();
        $userAchievement = UserAchievement::where('achievement_id', $achievement->id)->where('user_id', $user->id)->first();
        if (!$userAchievement->completed) {
            if ($userAchievement->start_date == NULL) {
                $userAchievement->start_date = now();
            }
            $userAchievement->days = (int) $userAchievement->start_date->diffInDays(now()) + 1;
            if ($userAchievement->days <= $achievement->days_needed) {
                $userAchievement->xp += $progress;
                if ($userAchievement->xp >=  $achievement->xp_needed) {
                    $userAchievement->completed = 1;
                    $userAchievement->xp = $achievement->xp_needed;
                    $user->achievements_earned++;
                }
            }
            else {
                $userAchievement->xp = 0;
                $userAchievement->xp += $progress;
                $userAchievement->start_date = now();
                $userAchievement->days = 1;
            }
        }
        $userAchievement->save();
    }
    public function consistencyIsKeyCheck(User $user) {
        $achievement = Achievement::where('achievement_name', 'Consistency is Key')->first();
        $userAchievement = UserAchievement::where('achievement_id', $achievement->id)->where('user_id', $user->id)->first();

        if ($userAchievement->updated_at != NULL && !$userAchievement->completed && (int) $userAchievement->updated_at->diffInDays(now()) + 1 > 2) {
            $userAchievement->days = 0;
            $userAchievement->save();
        }
    }

    public function whatIsRestCheck(User $user) {
        $achievement = Achievement::where('achievement_name', 'What is Rest?')->first();
        $userAchievement = UserAchievement::where('achievement_id', $achievement->id)->where('user_id', $user->id)->first();

        if ($userAchievement->start_date != NULL && !$userAchievement->completed && (int) $userAchievement->start_date->diffInDays(now()) + 1 > 7) {
            $userAchievement->days = 0;
            $userAchievement->xp = 0;
        }
        $userAchievement->save();
    }
}




