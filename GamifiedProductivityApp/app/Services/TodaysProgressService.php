<?php


namespace App\Services;

use App\Models\User;


class TodaysProgressService
{
    public function todaysProgress(User $user) {
        $now = now();
        $lastLogin = $user->last_login;

        if ($lastLogin->isToday()) {
            return false;
        }

        if ($lastLogin->isYesterday()) {
            $user->day_streak++;
        }
        else {
            $user->day_streak = 1;
        }

        $user->last_login = $now;
        $user->xp_today = 0;
        $user->tasks_completed_today = 0;
        return true;
    }
}
