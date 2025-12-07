<?php

namespace App\Services;

use App\Models\User;
use App\Models\Level;

class UserLevelService {
    public function updateUserLevel(User $user)
    {
        $levels = Level::all();
        foreach ($levels as $level) {
            if ($user->xp >= $level->min && $user->xp <= $level->max) {
                $user->level = $level->level;
                break;
            }
        }
    }
}
