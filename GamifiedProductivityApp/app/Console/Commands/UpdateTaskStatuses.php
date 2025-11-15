<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use Carbon\Carbon;

class UpdateTaskStatuses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:update-statuses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the on_time status for all tasks based on their due_date.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Starting task status update...");
        $overdueCount = Task::where('due_to', '<', Carbon::now())
            ->update(['on_time' => false]);
        $this->info("Marked {$overdueCount} tasks as overdue.");

        $onTimeCount = Task::where('due_to', '>=', Carbon::now())
            ->update(['on_time' => true]);
        $this->info("Marked {$onTimeCount} tasks as underdue.");

    }
}
