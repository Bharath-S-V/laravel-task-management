<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;  // Assuming you have a Task model
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'taskName' => 'required|string|max:255',
            'taskDetail' => 'required|string',
            'taskDate' => 'required|date',
            'taskPriority' => 'required|in:Low,Medium,High',
            'taskAssign' => 'required|exists:users,id',
            'taskProgress' => 'required|in:Not Started,In Progress,Completed',
        ]);

        // Create the task
        Task::create([
            'name' => $validated['taskName'],
            'details' => $validated['taskDetail'],
            'date' => $validated['taskDate'],
            'priority' => $validated['taskPriority'],
            'assigned_to' => $validated['taskAssign'],
            'progress' => $validated['taskProgress'],
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Task created successfully!');
    }
    public function update(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'name' => 'required|string|max:255',
            'details' => 'required|string',
            'taskDate' => 'required|date',
            'priority' => 'required|in:High,Medium,Low',
        ]);

        // Find the task and update it
        $task = Task::find($validatedData['task_id']);
        $task->name = $validatedData['name'];
        $task->details = $validatedData['details'];
        $task->date = $validatedData['taskDate'];
        $task->priority = $validatedData['priority'];
        $task->save();

        return redirect()->back()->with('success', 'Task updated successfully.');
    }

    public function destroy($id)
    {
        // Find the task by ID and delete it
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->back()->with('success', 'Task deleted successfully.');
    }
}
