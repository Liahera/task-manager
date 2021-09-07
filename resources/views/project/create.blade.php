@extends('layouts.app')

@section('content')

    <div>
        <div class="float-start">
            <h4 class="pb-3">Create a new Project</h4>
        </div>
        <div class="float-end">
            <a href="{{ route('project.show') }}" class="btn btn-info">
                <i class="fa fa-arrow-left"></i> All Project
            </a>
        </div>
        <div class="clearfix"></div>
    </div>

    <form id="project_form" action="{{ route('project.store') }}" method="POST">
        {{ csrf_field() }}

            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control" id="project" name="project">
                </div>

                <a href="{{ route('project.show') }}" class="btn btn-secondary mr-2"><i class="fa fa-arrow-left"></i>
                    Cancel</a>

                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i>
                    Save
                </button>
            </div>
    </form>

@endsection
