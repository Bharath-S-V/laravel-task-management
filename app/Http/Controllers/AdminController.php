<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch total users where `is_admin` is 0
        $totalUsers = User::where('is_admin', 0)->count();

        // Fetch total tasks from the task table
        $totalTasks = Task::count();

        // Fetch completed tasks where `progress` is 'completed'
        $completedTasks = Task::where('progress', 'completed')->count();

        // Pass the counts to the view
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return view('admin.dashboard', compact('totalUsers', 'totalTasks', 'completedTasks'));
        }

        return redirect()->route('login')->withErrors(['email' => 'Unauthorized access.']);
    }

    public function task()
    {
        $users = User::all(); // Fetch all users
        $tasks = Task::with('user')->get();
        $taskCount = $tasks->count();
        $completedTasksCount = Task::where('progress', 'Completed')->count();
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return view('admin.task', compact('users', 'tasks', 'taskCount', 'completedTasksCount'));
        }

        return redirect()->route('login')->withErrors(['email' => 'Unauthorized access.']);
    }



    public function user()
    {
        // Fetch non-admin users
        $users = User::where('is_admin', 0)->paginate(6);

        // Pass the users to the view
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return view('admin.user', ['users' => $users]);
        }

        return redirect()->route('login')->withErrors(['email' => 'Unauthorized access.']);
    }
    public function getNotifications()
    {
        // Assuming 'completed' tasks have a 'progress' status of 'completed'
        $completedTasks = Task::where('progress', 'completed')
            ->with('user') // Ensure you have this relationship in your Task model
            ->get();

        // Format notifications
        $notifications = $completedTasks->map(function ($task) {
            return [
                'message' => 'Task "' . $task->name . '" completed by ' . $task->user->name,
                // Adjust the route as necessary
            ];
        });

        return response()->json($notifications);
    }
}
