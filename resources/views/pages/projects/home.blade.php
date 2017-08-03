@extends('partials.bodywithsidenav')

@section('title', 'Project | 24 Hours')

@section('content')

<div class="container">
    <div class="row text-left">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-70">
            <h2>Projects <span class="small pull-right">{{ $today }} | {{$currenttime}}</span></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="pull-right">
                <a href="#createprojects" class="btn btn-sm btn-green" data-toggle="modal"><i class="fa fa-plus"></i>&nbsp;New Project</a>
                @if(count($projectsTrashed))
                    <a href="{{ url('projects/trashed') }}" class="btn btn-sm btn-red"><i class="fa fa-trash"></i>&nbsp;Trash&nbsp;<span class="badge">{{ count($projectsTrashed) }}</span></a>
                @endif
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @if(count($projects))
                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <thead>
                            <tr class="text-capitalize roboto">
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
                                    <td><a href="{{ action('ProjectController@show', $project->slug) }}">{{ $project->name }}</a></td>
                                    <td>{{ $project->user->name }}</td>
                                    <td>{{ count($project->tasks()->get()) }}</td>
                                    <td>{{ $project->created_at->diffForHumans() }}</td>
                                    <td>{{ $project->updated_at->diffForHumans() }}</td>
                                    <td>{{ Carbon\Carbon::createFromTimestamp(strtotime($project->duedate))->diffForHumans() }}</td>
                                    <td>{{ $project->completed == false ? 'pending' : 'completed'}}</td>
                                    <td class="col-sm-3">
                                        <ul class="list-inline col-sm-12">
                                            <li class="col-sm-3">
                                                {!! Form::open(['method' => 'POST', 'action' => ['ProjectController@edit', $project->slug], 'class' => 'form-horizontal']) !!}
                                                    @include('partials.forms.edit.projects', ['submitTextButton' => 'Edit'])
                                                {!! Form::close() !!}
                                            </li>
                                            <li class="col-sm-3">
                                                {!! Form::open(['method' => 'DELETE', 'action' => ['ProjectController@hide', $project->slug], 'class' => 'form-horizontal']) !!}
                                                    @include('partials.forms.delete', ['submitTextButton' => 'Hide'])
                                                {!! Form::close() !!}
                                            </li>
                                            <li class="col-sm-3">
                                                {!! Form::model($project, ['method' => 'PATCH', 'action' => ['ProjectController@completed', $project->slug], 'class' => 'form-horizontal']) !!}
                                                    <button type="submit" class="btn btn-xs btn-primary">{{ $project->completed == true ? 'Mark pending' : 'Mark complete' }}</button>
                                                {!! Form::close() !!}
                                            </li>
                                        </ul>
                                    </td>
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

@include('pages.projects.modals.create.projects', ['submitTextButton' => 'Save'])

@if(count($projects))
    @include('pages.projects.modals.edit.projects', ['submitTextButton' => 'Update'])
@endif

@stop