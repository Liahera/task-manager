<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        $tasks = Task::orderBy('id','desc')->paginate(3);
        return view('tasks.index',compact('tasks','projects'));
    }
    public function create()
    {
        $projects = Project::all();
        $users =  User::all();
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
        return view('tasks.create', compact('statuses','users','projects'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $task = new Task();
        $task->user_id=$request->user;
        $task->project_id=$request->project_id;
        $task->name = $request->name;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->save();
        return redirect()->route('task.index');
    }
    public function show($id)
    {
        $task_show = Task::findOrFail($id);
        $projects = Project::all() ;
        return view('tasks.show',compact('task_show'));
    }

    public function edit($id)
    {
        $projects = Project::all();
        $users =  User::all();
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
        return view('tasks.edit', compact('statuses', 'task','projects','users'));
    }
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $request->validate([
            'name' => 'required'
        ]);

        $task->user_id=$request->user;
        $task->project_id=$request->project_id;
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

