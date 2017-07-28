@extends('partials.bodywithoutsidenav')

@section('title', 'Project | ToDoApp')

@section('content')

<div class="container">
    <div class="row text-left">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-70">
            <h2>Projects <span class="pull-right">{{$today}} | {{$currenttime}}</span></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="pull-right">
                <a href="#createprojects" class="btn btn-sm btn-green" data-toogle="modal"><i class="fa fa-plus"></i>&nbsp;New Project</a>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @if(count($projects))
                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <thead>
                            <tr class="text-capitalized roboto">
                                <th>id</th>
                                <th>name</th>
                                <th>author</th>
                                <th>tasks</th>
                                <th>created</th>
                                <th>updated</th>
                                <th>duedate</th>
                                <th>status</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        @foreach($projects as $project)
                            <tbody>
                                <tr>
                                    <td>{{ $project->id }}</td>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->user->name }}</td>
                                    <td>{{ count($project->task()->get()) }}</td>
                                    <td>{{ $project->created_at }}</td>
                                    <td>{{ $project->updated_at }}</td>
                                    <td>{{ $project->duedate }}</td>
                                    <td>{{ $project->completed == false ? 'pending' : 'completed'}}</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            @else
                <p>Sorry, no projects found today, begin by creating by a <a href="#createprojects" class="" data-toggle="modal">new project.</a></p>
            @endif
        </div>
    </div>
</div>
@stop