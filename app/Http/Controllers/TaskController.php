<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('id','desc')->get();

        return view('tasks.index',compact('tasks'));
    }
    public function create()
    {
        $statuses = [
            [
                'label' => 'New',
                'value' => 'New',
            ],
            [
                'label'=>'In progress',
                'value' =>'In progress',
            ],
            [
                'label' => 'Done',
                'value' => 'Done',
            ]
        ];
        return view('tasks.create', compact('statuses'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $task = new Task();
        $task->name = $request->name;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->save();
        return redirect()->route('task.index');
    }
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $statuses = [
            [
                'label' => 'New',
                'value' => 'New',
            ],
            [
                'label'=>'In progress',
                'value' =>'In progress',
            ],
            [
                'label' => 'Done',
                'value' => 'Done',
            ]
        ];
        return view('tasks.edit', compact('statuses', 'task'));
    }
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $request->validate([
            'name' => 'required'
        ]);

        $task->name = $request->name;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->save();
        return redirect()->route('task.index');
    }
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('task.index');
    }

}

