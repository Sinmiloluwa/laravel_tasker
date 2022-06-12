<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
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

        return view('admin.tasks.create');
    }

    public function update(Task $task)
    {
        $this->authorize('update', Task::class);

        return view('admin.tasks.edit', compact('task'));
    }

    public function destroy(Task $task)
    {
        $task->delete();
    }

}
