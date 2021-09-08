@extends('layouts.app')

@section('content')
    <style>
        .row-cols-4 {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            top: -100px;
            right: -400px;
        }

        .panel-primary {
            display: flex;
            flex-direction: column;
            position: relative;
            top: -230px;
            left: -700px;

        }
    </style>

    <div class="col-md-8">
        <h1>{!! $task_show->name  !!}</h1>

        <div class="form-group">
            <label>Description:</label>
            <p>{!! $task_show->description!!}</p>
        </div>
        <div class="btn-group">
            <a href="#" class="btn btn-secondary mr-2"><i class="fa fa-arrow-left"></i>
                Cancel</a>

            <a href="#" class="btn btn-success">
                <i class="fa fa-edit"></i>
            </a>

        </div>
        <div class="row-cols-4">
            <div class="panel panel-info">
                <div class="panel-heading">Project</div>
                <div class="panel-body">
            <span class="label label-jc text-black">
               <h5>{{ $task_show->project->project_name }}</h5>
            </span>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">Responsible user</div>
                <div class="panel-body">
            <span class="label label-jc text-black">
                <small>  <h5>{{ $task_show->user->name }}</h5></small>
            </span>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">Status</div>
                <div class="panel-body">
                    @if($task_show->status === "New")
                        <span class="badge rounded-pill bg-primary text-white">
                  New
                </span>
                    @elseif($task_show->status === "In progress")
                        <span class="badge rounded-pill bg-info text-white">
                   In progress
                </span>
                    @else
                        <span class="badge rounded-pill bg-success text-white">
                   Done
                </span>
                    @endif
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">Created</div>
                <div class="panel-body">
                    {{ $task_show->created_at }}
                </div>
            </div>
            @if( count($images_set) > 0 )
                <div class="panel panel-primary">
                    <div class="panel-heading">Uploaded Images</div>
                    <div class="panel-body">
                        <ul id="images_col">
                            @foreach ( $images_set as $image )
                                <a href="<?php echo asset("images/$image") ?>" data-lightbox="images-set">
                                    <img class="img-responsive" src="<?php echo asset("images/$image") ?>">
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            @if( count($files_set) > 0 )
                <div class="panel panel-primary">
                    <div class="panel-heading"> Uploaded Files</div>
                    <div class="panel-body">
                        <ul id="images_col">
                            @foreach ( $files_set as $file )
                                <a target="_blank" href="<?php echo asset("images/$file"); ?>">{{ $file }}</a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

        </div>
@endsection




