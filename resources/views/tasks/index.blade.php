@extends('layouts.app')
@section('content')
    <div>
        <div class="float-start">
            <h4 class="pb-3">My Tasks</h4>
        </div>
        <div class="float-end">
            <a href="{{route('task.create')}}" class="btn btn-info">
                <i class="fa fa-plus-circle"></i> Create Task
            </a>
        </div>
        <div class="clearfix"></div>
    </div>
    @foreach ($tasks as $task)
        <div class="card mt-3">
            <h5 class="card-header">
                @if($task->status === 'New')
                    {{$task->name}}
                @elseif($task->status === 'In progress')
                    {{$task->name}}
                @else
                    <del> {{$task->name}}</del>
                @endif
                <span class="badge rounded-pill bg-warning text-dark">
                    {{$task->created_at->diffForHumans()}}
                </span>
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
            </h5>
            <div class="card-body">
                <div class="card-text">
                    <div class="float-start">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Project Name</th>
                                <th>Created </th>
                                <th>Last Updated</th>
                                <th>Assign to</th>

                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $task->project->project_name }}</td>
                                    <td>{{$task->created_at->diffForHumans()}}</td>
                                    <td>{{ $task->updated_at->diffForHumans() }}</td>
                                    <td>{{$task->user->name}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="float-end">
                        <a href="{{ route('task.show', $task->id) }}" class="btn btn-secondary">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('task.edit', $task->id) }}" class="btn btn-success">
                            <i class="fa fa-edit"></i>
                        </a>
                        <form action="{{ route('task.destroy', $task->id) }}" style="display: inline" method="POST"
                              onsubmit="return confirm('Are you sure to delete ?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            @endforeach
            @if (count($tasks) === 0)
                <div class="alert alert-danger p-2">
                    No Task Found. Please Create one task
                    <br>
                    <br>
                    <a href="{{ route('task.create') }}" class="btn btn-info">
                        <i class="fa fa-plus-circle"></i> Create Task
                    </a>
                </div>
            @endif
            <div class="pagination col-lg-12 col-md-12 col-sm-12 text-center">
                <ul class="pagination" role="navigation">
                    {{$tasks->links()}}
                </ul>
            </div>

@endsection
