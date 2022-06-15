<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks->where('completed',0);

        return view('user.tasks.index', compact('tasks'));
    }

    public function completed($task)
    {
        Task::where('id',$task)->update([
            'completed_at' => Carbon::now(),
            'completed' => 1
        ]);

        return redirect()->back()->with('success', 'You completed your task');  
    }

    public function comments()
    {
        $tasks = auth()->user()->tasks->where('comments', '!=', 'NULL')->where('completed',0);

        foreach($tasks as $task)
        {
            $task->update([
                'read' => 1
            ]);
        }

        return view('user.tasks.comments', compact('tasks'));
    }
}
