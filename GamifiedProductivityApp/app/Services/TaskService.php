<?php

namespace App\Services;

use App\Models\Task;
use Carbon\Carbon;
use App\Models\User;
class TaskService {
    public function isTaskOnTime(User $user) {
        $tasks = Task::where('user_id', $user->id)->get();
        $now = Carbon::now($user->timezone);
        foreach($tasks as $task) {
            if ($now > $task->due_to)  {
                $task->on_time = 0;
                $task->save();
            }
        }
    }
}
