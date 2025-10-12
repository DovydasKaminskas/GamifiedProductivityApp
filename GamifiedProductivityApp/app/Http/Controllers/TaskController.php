<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function create (Request $request) {
        $validated = $request->validate([
            'task_name' => 'required|string|max:50',
            'priority' => 'required|string',
            'xp' => 'required|integer',
            'type' => 'required|string',
            'due_to' => 'required|date'
        ]);
        $validated['user_id'] = Auth::id(); // Assign current user's ID
        $task = Task::create($validated);

        return redirect()->route('show.dashboard');
    }
    public function update(Request $request, $id) {
        $request->validate([
            'task_name' => 'required|string|max:50',
            'priority' => 'required|string',
            'xp' => 'required|integer',
            'type' => 'required|string',
            'due_to' => 'required|date'
        ]);
        $task = Task::find($id);
        $task->update($request->all());
        return redirect()->route('show.dashboard');
    }
    public function destroy ($id) {
        $task = Task::find($id);
        $user = Auth::user();
        $user->xp += $task->xp;
        $user->save();
        $task->delete();
        return redirect()->route('show.dashboard')
            ->with('success', 'Task deleted successfully');
    }

//    public function checkExpired(Request $request, TaskService $taskService) {
//        $taskService->store($request->id);
//        return redirect()->route('show.dashboard');
//    }
}
