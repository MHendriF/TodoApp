@extends('partials.bodywithsidenav')

@section('title', 'Show Project Details | 24 Hours')

@section('content')

<div class="container">
    <div class="row text-left">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-70">
            <h2>{{ ucwords($project->name) }} <span class="small pull-right">{{$today}} | {{$currenttime}}</span></h2>
            <p class="text-muted">
                Posted by:&nbsp;{{ ucwords($project->user->name) }} | {{ $project->created_at->format('h:i a') }} | {{ $project->created_at->formatlocalized('%a %d %b %y') }}
            </p>
            <p class="font120">{{ $project->desc }}</p>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('projects') }}">Projects</a>
                </li>
                <li>
                    <a href="{{ url('projects/show') }}">{{ ucwords($project->slug) }}</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="pull-right">
                <a href="#createtasks" class="btn btn-sm btn-green" data-toggle="modal"><i class="fa fa-plus"></i>&nbsp;New Task</a>
                @if(count($tasksTrashed))
                    <a href="{{ url('tasks/trashed') }}" class="btn btn-sm btn-red"><i class="fa fa-trash"></i>&nbsp;Trash&nbsp;<span class="badge">{{ count($tasksTrashed) }}</span></a>
                @endif
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @if(count($tasks))
                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <thead>
                            <tr class="text-capitalize roboto">
                                <th>id</th>
                                <th>name</th>
                                <th>author</th>
                                <th>subtasks</th>
                                <th>created</th>
                                <th>updated</th>
                                <th>due date</th>
                                <th>status</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        @foreach($tasks as $index => $task)
                            <tbody>
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ $project->user->name }}</td>
                                    <td>{{ count($task->subtasks()->get()) }}</td>
                                    <td>{{ $task->created_at->diffForHumans() }}</td>
                                    <td>{{ $task->updated_at->diffForHumans() }}</td>
                                    <td>{{ Carbon\Carbon::createFromTimestamp(strtotime($task->duedate))->diffForHumans() }}</td>
                                    <td>{{ $task->completed == false ? 'pending' : 'completed'}}</td>
                                    <td class="col-sm-3">
                                        <ul class="list-inline col-sm-12">
                                            <li class="col-sm-3">
                                                {!! Form::open(['method' => 'POST', 'action' => ['TaskController@edit', $project->slug, $task->slug], 'class' => 'form-horizontal']) !!}
                                                    @include('partials.forms.edit.tasks', ['submitTextButton' => 'Edit'])
                                                {!! Form::close() !!}
                                            </li>
                                            <li class="col-sm-3">
                                                {!! Form::open(['method' => 'DELETE', 'action' => ['TaskController@hide', $project->slug, $task->slug], 'class' => 'form-horizontal']) !!}
                                                    @include('partials.forms.delete', ['submitTextButton' => 'Hide'])
                                                {!! Form::close() !!}
                                            </li>
                                            <li class="col-sm-3">
                                                {!! Form::model($task, ['method' => 'PATCH', 'action' => ['TaskController@completed', $project->slug, $task->slug], 'class' => 'form-horizontal']) !!}
                                                    <button type="submit" class="btn btn-xs btn-primary">{{ $task->completed == true ? 'Mark pending' : 'Mark complete' }}</button>
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
                <p>Sorry, no task found today, begin by creating by a <a href="#createtasks" class="" data-toggle="modal">new task.</a></p>
            @endif
        </div>
    </div>
</div>

@include('pages.projects.modals.create.tasks', ['submitTextButton' => 'Save'])

@if(count($tasks))
    @include('pages.projects.modals.edit.tasks', ['submitTextButton' => 'Update'])
@endif

@stop