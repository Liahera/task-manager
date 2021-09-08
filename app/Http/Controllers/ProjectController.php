<?php

namespace App\Http\Controllers;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
       // $projects = Project::all()->orderBy('id')->paginate(5);
        $projects = Project::orderby('id', 'desc')->paginate(5);
        return view('project.index', compact('projects'));
    }

    public function create()
    {
        return view('project.create');
    }
    public function store(Request $request)
    {
            $this->validate($request, [
                'project' => 'required'
            ]);

            $project_new = new Project;
            $project_new->project_name = $request->project;
            $project_new->save();

            return redirect()->route('project.show');
    }
    public function edit($id)
    {
        $edit_project =  Project::findOrFail($id);
        return view('project.edit',compact('edit_project'));
    }
    public function update(Request $request, $id)
    {
        $update_project = Project::findOrFail($id);
        $update_project->project_name = $request->project;
        $update_project->save();
        return redirect()->route('project.show');
    }
    public function destroy($id)
    {
        $delete_project = Project::findOrFail($id);
        $delete_project->delete();
        return redirect()->back();

    }



}
