<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('user')->orderBy('due_date')->get();

        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $this->authorize('create', Task::class);

        $users = User::where('is_admin',0)->get(['name','id']);

        return view('admin.tasks.create', compact('users'));
    }

    public function update(Task $task)
    {
        $this->authorize('update', Task::class);

        return view('admin.tasks.edit', compact('task'));
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', Task::class);

        $task->delete();

        return redirect()->route('admin.tasks.index');
    }
    
    public function store(Request $request)
    {
        $name = $request->description;
        $user = $request->user;
        $date = $request->due_date;

        Task::create([
            'description' => $name,
            'due_date' => $date,
            'user_id' => $user
        ]);

        return redirect()->route('admin.tasks.index');
    }

    public function completed()
    {
        $tasks = Task::where('completed',1)->get();
        
        return view('admin.completed', compact('tasks'));
    }

    public function comment(Request $request, $task)
    {
        Task::where('id',$task)->update([
            'comments' => $request->comment,
            'read' => 0,
            'completed' => 0
        ]);

        return redirect()->back(); 
    }

    public function approve($task)
    {
        Task::where('id',$task)->update([
            'approved' => 1
        ]);

        return redirect()->route('admin.tasks.index');
    }

}
