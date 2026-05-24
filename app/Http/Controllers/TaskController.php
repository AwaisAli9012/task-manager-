<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks()->latest()->get();

        return Inertia::render('Tasks/Index', [
            'tasks' => $tasks
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:pending,in_progress,completed',
            'due_date' => 'nullable|date',
        ]);

        auth()->user()->tasks()->create($validated);

        return redirect()->back();
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:pending,in_progress,completed',
            'due_date' => 'nullable|date',
        ]);

        $task->update($validated);

        return redirect()->back();
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->back();
    }

    public function updateStatus(Request $request, Task $task)
    {
        $task->update(['status' => $request->status]);

        return redirect()->back();
    }
}