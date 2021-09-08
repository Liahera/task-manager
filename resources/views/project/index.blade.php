@extends('layouts.app')
@section('content')

    <div>
        <div class="float-start">
            <h4 class="pb-3">My PROJECTS</h4>
        </div>
        <div class="float-end">
            <a  href="{{route('project.create')}}" class="btn btn-info">
                <i class="fa fa-plus-circle"></i> Create Project
            </a>
        </div>
        <div class="clearfix"></div>
    </div>

    @foreach ($projects as $project)
        <div class="card mt-3">
            <h5 class="card-header">
                {{$project->project_name}}
    <span class="badge rounded-pill bg-warning text-dark">
                    {{$project->created_at->diffForHumans()}}
                </span>
                <a href="{{route('task.list',[ 'project_id' => $project->id ])}}">Task list</a>
                <div class="float-end">
                    <a  href="{{route('project.edit',[ 'id' => $project->id ])}}" class="btn btn-success">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('project.delete', [ 'id' => $project->id ]) }}" style="display: inline" method="POST" onsubmit="return confirm('Are you sure to delete ?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </div>
                <div class="clearfix"></div>
            </h5>
        </div>
    @endforeach
    <div class="pagination col-lg-12 col-md-12 col-sm-12 text-center">
        <ul class="pagination" role="navigation">
            {{$projects->links()}}
        </ul>
    </div>
@endsection
