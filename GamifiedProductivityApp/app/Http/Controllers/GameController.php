<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function showIndex () {
        return view('index');
    }
    public function showDashboard(TaskService $taskService) {
        $user = Auth::user();
        $tasks = Task::where('user_id', $user->id)->orderBy('due_to', 'asc')->orderByRaw("FIELD(priority, 'very high', 'high', 'medium', 'low')")->get();
        $taskService->isTaskOnTime($user);
        return view('dashboard.dashboard', ['tasks' => $tasks]);
    }
    public function showLeaderboard() {
        return view('leaderboard');
    }
    public function showHowToPlay() {
        return view('howToPlay');
    }
    public function showTaskCreate() {
        return view('dashboard/createTask');
    }

}
