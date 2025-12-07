<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Task;
use App\Models\User;
use App\Services\AchievementService;
use App\Services\TaskService;
use App\Services\TodaysProgressService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function showIndex () {

        return view('index');
    }
    public function showDashboard(TodaysProgressService $todaysProgressService, AchievementService $achievementService) {
        $user = Auth::user();
        $tasks = Task::where('user_id', $user->id)->orderBy('on_time', 'desc')->orderBy('due_to', 'asc')->orderByRaw("FIELD(priority, 'very high', 'high', 'medium', 'low')")->get();
        $level = Level::where('level', $user->level)->first();
        $todaysProgressService->todaysProgress($user);
        $achievementService->alwaysOn($user);
        $achievementService->consistencyIsKeyCheck($user);
        $achievementService->whatIsRestCheck($user);
        $user->save();
        return view('dashboard.dashboard', compact('user','tasks', 'level'));
    }
    public function showLeaderboard(Request $request) {
        if ($request->has('page') || $request->has('sort') || !Auth::user()) {
            $users = User::filter()->orderBy('level', 'desc')->orderBy('xp', 'desc')->orderBy('tasks_completed', 'desc')->paginate(15)->withQueryString();
            return view('leaderboard', compact('users' ));
        }
        else  {
            $user = Auth::user();
            $usersAboveByLevel = User::where('level', '>', $user->level)->count();
            $usersAboveByXp = User::where('level', $user->level)->where('xp', '>', $user->xp)->count();

            $usersAbove = $usersAboveByLevel + $usersAboveByXp + 1;
            $page = ceil($usersAbove / 15);
            return redirect()->route('show.leaderboard', array_merge($request->all(), ['page' => $page]));
        }
    }
    public function showHowToPlay() {
        return view('howToPlay');
    }
}
