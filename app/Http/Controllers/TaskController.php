<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskFiles;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        $tasks = Task::orderBy('id', 'desc')->paginate(3);
        return view('tasks.index', compact('tasks', 'projects'));
    }

    public function create()
    {
        $projects = Project::all();
        $users = User::all();
        $statuses = [
            [
                'label' => 'New',
                'value' => 'New',
            ],
            [
                'label' => 'In progress',
                'value' => 'In progress',
            ],
            [
                'label' => 'Done',
                'value' => 'Done',
            ]
        ];
        return view('tasks.create', compact('statuses', 'users', 'projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'photos.*' => 'sometimes|required|mimes:png,gif,jpeg,jpg,txt,pdf,doc'
        ]);

        $task = new Task();
        $task->user_id = $request->user;
        $task->project_id = $request->project_id;
        $task->name = $request->name;
        $task->description = $request->description;
        $task->status = $request->status;
         $task->save();

        if ($request->hasFile('photos')) {
            foreach ($request->photos as $file) {

                $filename = strtr(pathinfo(time() . '_' . $file->getClientOriginalName(), PATHINFO_FILENAME), [' ' => '', '.' => '']) . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                $file->move('images', $filename);
                $task->save();
                // save to DB
                TaskFiles::create([
                    'task_id' => $task->id,
                    'filename' => $filename

                ]);
            }
        }
        return redirect()->route('task.index');
    }

    public function show($id)
    {
        $images_set = [];
        $files_set = [];
        $images_array = ['png', 'gif', 'jpeg', 'jpg'];
        $taskfiles = TaskFiles::where('task_id', $id)->get();

        if (count($taskfiles) > 0) {
            foreach ($taskfiles as $taskfile) {


                $taskfile = explode(".", $taskfile->filename);
                if (in_array($taskfile[1], $images_array))
                    $images_set[] = $taskfile[0] . '.' . $taskfile[1];
                else
                    $files_set[] = $taskfile[0] . '.' . $taskfile[1];
            }
        }
        $task_show = Task::findOrFail($id);
        $projects = Project::all();
        return view('tasks.show', compact('task_show', 'taskfiles', 'images_set', 'files_set', 'images_set', 'projects'));
    }

    public function taskList($project_id)
    {
        $users = User::all();
        $project_name = Project::findOrFail($project_id);
        $task_list = Task::where('project_id', '=', $project_id)->get();
        return view('tasks.list', compact('users', 'project_name', 'task_list'));
    }


    public function edit($id)
    {
        $projects = Project::all();
        $users = User::all();
        $task = Task::findOrFail($id);
        $taskfiles = TaskFiles::where('task_id', '=', $id)->get();
        $statuses = [
            [
                'label' => 'New',
                'value' => 'New',
            ],
            [
                'label' => 'In progress',
                'value' => 'In progress',
            ],
            [
                'label' => 'Done',
                'value' => 'Done',
            ]
        ];
        return view('tasks.edit', compact('statuses', 'task', 'projects', 'users', 'taskfiles'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'photos.*' => 'sometimes|required|mimes:png,gif,jpeg,jpg,txt,pdf,doc'
        ]);

        $task->user_id = $request->user;
        $task->project_id = $request->project_id;
        $task->name = $request->name;
        $task->description = $request->description;
        $task->status = $request->status;

        if ($request->hasFile('photos')) {
            foreach ($request->photos as $file) {
                $filename = strtr(pathinfo(time() . '_' . $file->getClientOriginalName(), PATHINFO_FILENAME), [' ' => '', '.' => '']) . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                $file->move('images', $filename);
                TaskFiles::create([
                    'task_id' => $request->task_id,
                    'filename' => $filename
                ]);
            }
        }
        $task->save();
        return redirect()->route('task.index');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('task.index');
    }

    public function deleteFile($id)
    {
        $delete_file = TaskFiles::find($id);
        unlink(public_path() . '/images/' . $delete_file->filename);
        $delete_file->delete();
        return redirect()->back();
    }

}

