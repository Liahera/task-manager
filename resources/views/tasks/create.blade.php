@extends('layouts.app')
@section('content')
    <div>
        <div class="float-start">
            <h4 class="pb-3">Create Task</h4>
        </div>
        <div class="float-end">
            <a href="{{ route('task.index') }}" class="btn btn-info">
                <i class="fa fa-arrow-left"></i> All Task
            </a>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="card card-body bg-light p-4">
        <form action="{{ route('task.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea type="text" class="form-control" id="description" name="description" rows="5"></textarea>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    @foreach ($statuses as $status)
                        <option value="{{ $status['value'] }}">{{ $status['label'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Assign to Project <span class="glyphicon glyphicon-pushpin"
                                                   aria-hidden="true"></span></label>
                    <select name="project_id" class="selectpicker" data-style="btn-primary" style="width:100%;">
                        @foreach( $projects as $project )
                            <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Assign to: <span class="glyphicon glyphicon-user" aria-hidden="true"></span></label>
                    <select id="user" name="user" class="selectpicker" data-style="btn-info" style="width:100%;">
                        @foreach ( $users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach

                    </select>
                </div>
                <label>Add Project Files (png,gif,jpeg,jpg,txt,pdf,doc) <span class="glyphicon glyphicon-file"
                                                                              aria-hidden="true"></span></label>
                <div class="form-group">
                    <input type="file" class="form-control" name="photos[]" multiple>
                </div>

                <a href="{{ route('task.index') }}" class="btn btn-secondary mr-2"><i class="fa fa-arrow-left"></i>
                    Cancel</a>

                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i>
                    Save
                </button>
            </div>
        </form>
    </div>

@endsection
