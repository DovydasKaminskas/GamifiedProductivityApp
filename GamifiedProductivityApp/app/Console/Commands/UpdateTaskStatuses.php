<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Models\Task;
use Carbon\Carbon;

class UpdateTaskStatuses extends Command
{
    protected $signature = 'tasks:update-statuses';

    protected $description = 'Updates the on_time status for all tasks based on their due_date.';

    public function handle()
    {
        $userTimezones = User::whereHas('tasks')->pluck('timezone')->unique();
        $this->info("User Timezones found: " . $userTimezones->implode(', '));

        foreach($userTimezones as $timezone) {
            $currentTimeInTimezone = Carbon::now($timezone);
            $usersInThisTimezone = User::where('timezone', $timezone)->get();

            foreach($usersInThisTimezone as $user) {
                Task::where('user_id', $user->id)
                    ->where('due_to', '<', $currentTimeInTimezone)
                    ->update(['on_time' => false]);

                Task::where('user_id', $user->id)
                    ->where('due_to', '>=', $currentTimeInTimezone)
                    ->update(['on_time' => true]);
            }
        }
    }
}
