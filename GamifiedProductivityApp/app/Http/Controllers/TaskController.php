<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function create (Request $request) {
        $validated = $request->validate([
            'task_name' => 'required|string|max:50',
            'xp' => 'required|integer',
            'type' => 'required|string',
            'due_to' => 'required|date',
            'priority' => 'required|string',
        ]);
        $validated['user_id'] = Auth::id(); // Assign current user's ID
        $task = Task::create($validated);

        return redirect()->route('show.dashboard');
    }

}
