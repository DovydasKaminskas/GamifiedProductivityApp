<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\AchievementService;
use App\Services\UserLevelService;
use App\Services\TodaysProgressService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function create() {
        return view('dashboard.modal.createTask');
    }
    public function store (Request $request) {
        $validated = $request->validate([
            'task_name' => 'required|string|max:50',
            'priority' => 'required|string|in:Low,Medium,High,Very high',
            'xp' => 'required|integer|min:1|max:200',
            'type' => 'required|string|in:Work,School,Exercise,Creativity,Chores,Health,Religion,Other',
            'due_to' => 'required|date|after_or_equal:now'

        ]);
        $validated['user_id'] = Auth::id(); // Assign current user's ID
        Task::create($validated);

        return redirect()->route('show.dashboard');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('dashboard.modal.editTask', compact('task'));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'task_name' => 'required|string|max:50',
            'priority' => 'required|string|in:Low,Medium,High,Very high',
            'xp' => 'required|integer|min:1|max:200',
            'type' => 'required|string|in:Work,School,Exercise,Creativity,Chores,Health,Religion,Other',
            'due_to' => 'required|date|after_or_equal:now'
        ]);
        $task = Task::find($id);
        $task->update($validated);

        return redirect()->route('show.dashboard');
    }
    public function destroy ($id, UserLevelService $levelService, AchievementService $achievementService) {
        $task = Task::find($id);
        $user = Auth::user();
        if ($task->on_time != 0) {
            $user->xp += $task->xp;
            $user->xp_today += $task->xp;
            $user->tasks_completed++;
            $user->tasks_completed_today++;
            $levelService->updateUserLevel($user);
            $achievementService->taskCrusher($user);
            $achievementService->consistencyIsKey($user);
            $achievementService->xpHunter($user, $task->xp);
            $achievementService->whatIsRest($user, $task->xp);
            $user->save();
        }
        $task->delete();
        return redirect()->route('show.dashboard')
            ->with('success', 'Task deleted successfully');
    }
}
