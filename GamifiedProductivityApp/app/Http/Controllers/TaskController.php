<?php

namespace App\Http\Controllers;

use App\Models\Task;
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
            'priority' => 'required|string|in:Low,Medium,High,Very High',
            'xp' => 'required|integer|min:1|max:200',
            'type' => 'required|string|in:Work,School,Exercise,Creativity,Chores,Health,Religion,Other',
            'due_to' => 'required|date|after_or_equal:now'

        ]);
        $validated['user_id'] = Auth::id(); // Assign current user's ID
        $task = Task::create($validated);

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
            'priority' => 'required|string|in:Low,Medium,High,Very High',
            'xp' => 'required|integer|min:1|max:200',
            'type' => 'required|string|in:Work,School,Exercise,Creativity,Chores,Health,Religion,Other',
            'due_to' => 'required|date|after_or_equal:now'
        ]);
        $task = Task::find($id);
        $task->update($validated);

//        return response()->json(['success' => true]);
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
