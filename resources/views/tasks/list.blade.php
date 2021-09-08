@extends('layouts.app')
@section('content')


    <div>
        <div class="float-start">
            <h4 class="pb-3"> <h1>Project Task List for:  "{{ $project_name->project_name }}" </h1></h4>
        </div>
        <div class="float-end">
            <a  href="{{route('task.create')}}" class="btn btn-info">
                <i class="fa fa-plus-circle"></i> Create Task
            </a>
        </div>
        <div class="clearfix"></div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Task Name</th>
            <th>Project Name</th>
            <th>Description</th>
            <th>Status</th>
            <th>Created </th>
            <th></th>
        </tr>
        </thead>

        @if ( !$task_list->isEmpty() )
            <tbody>
            @foreach ( $task_list as $task)
                <tr>
                    <td>{{ $task->name }} </td>
                    <td>{{ $task->project->project_name }}</td>
                    <td>{{$task->description}}</td>
                    <td>
                        @if($task->status === "New")
                            <span class="badge rounded-pill bg-primary text-white">
                  New
                </span>
                        @elseif($task->status === "In progress")
                            <span class="badge rounded-pill bg-info text-white">
                   In progress
                </span>
                        @else
                            <span class="badge rounded-pill bg-success text-white">
                   Done
                </span>
                        @endif
                    </td>
                    <td>{{$task->created_at->diffForHumans()}}</td>

                    <td>

                        <div class="float-end">
                            <a  href="{{ route('task.show', $task->id) }}" class="btn btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a  href="{{ route('task.edit', $task->id) }}" class="btn btn-success">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('task.destroy', $task->id) }}" style="display: inline" method="POST" onsubmit="return confirm('Are you sure to delete ?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>

                    </td>
                </tr>

            @endforeach
            </tbody>
        @else
            <p><em>There are no tasks assigned yet</em></p>
        @endif


    </table>


@endsection
