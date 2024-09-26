<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Assuming you're using Laravel's Auth for user authentication
        $userId = auth()->user()->id;

        // Count total tasks assigned to the user
        $totalTasks = \App\Models\Task::where('assigned_to', $userId)->count();

        // Count tasks that are marked as completed for the user
        $completedTasks = \App\Models\Task::where('assigned_to', $userId)
            ->where('progress', 'completed')
            ->count();

        return view('user.dashboard', compact('totalTasks', 'completedTasks'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8', // Use confirmed for password validation
        ]);

        try {
            // Create a new user
            $user = User::create([
                'name' => $request->name,
                'designation' => $request->designation,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Hash the password
                'is_admin' => false, // Set to false or true based on your requirement
            ]);

            return redirect()->back()->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'User could not be created: ' . $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        // Fetch the user by id
        $user = User::findOrFail($id);

        // Return the edit view with the user data
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return view('admin.edit', compact('user'));
        }

        return redirect()->route('login')->withErrors(['email' => 'Unauthorized access.']);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->designation = $request->designation;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.user')->with('success', 'User updated successfully');
    }



    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Option 1: Delete related tasks
        $user->tasks()->delete(); // Assuming you have a relationship defined in the User model

        // Option 2: Update related tasks to remove the association
        // Task::where('assigned_to', $id)->update(['assigned_to' => null]);

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully');
    }
    public function task()
    {
        // Get the logged-in user's ID
        $userId = auth()->user()->id;

        // Fetch tasks assigned to the logged-in user
        $tasks = \App\Models\Task::where('assigned_to', $userId)->get();

        // Count completed and pending tasks
        $completedTasksCount = $tasks->where('progress', 'completed')->count();
        $pendingTasksCount = $tasks->where('progress', '!=', 'completed')->count();
        $taskCount = $tasks->count();

        return view('user.task', compact('tasks', 'completedTasksCount', 'pendingTasksCount', 'taskCount'));
    }
    public function completeTask(Request $request, $id)
    {
        // Find the task by ID
        $task = Task::findOrFail($id);

        // Update the task's progress to 'completed'
        $task->progress = 'completed';
        $task->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Task marked as completed successfully.');
    }
}
