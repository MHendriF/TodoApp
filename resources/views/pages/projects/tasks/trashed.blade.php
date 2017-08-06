@extends('partials.bodywithsidenav')

@section('title', 'Trashed Project | 24 Hours')

@section('content')

<div class="container">
    <div class="row text-left">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-70">
            <h2>Trashed Tasks <span class="small pull-right">{{$today}} | {{$currenttime}}</span></h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('projects') }}">Tasks</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="pull-right">
                <a href="{{ url('projects') }}" class="btn btn-sm btn-green" data-toggle="modal"><i class="fa fa-plus"></i>&nbsp;Back to task</a>
                @if(count($tasksTrashed))
                    <a href="{{ url('tasks/restoreall') }}" class="btn btn-sm btn-green"><i class="fa fa-check"></i>&nbsp;Restore all&nbsp;<span class="badge">{{ count($tasksTrashed) }}</span></a>
                @endif
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @if(count($tasksTrashed))
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
                                <th>duedate</th>
                                <th>status</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        @foreach($tasksTrashed as $task)
                            <tbody>
                                <tr>
                                    <td>{{ $task->id }}</td>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ $task->user->name }}</td>
                                    <td>{{ count($task->subtasks()->get()) }}</td>
                                    <td>{{ $task->created_at->diffForHumans() }}</td>
                                    <td>{{ $task->updated_at->diffForHumans() }}</td>
                                    <td>{{ Carbon\Carbon::createFromTimestamp(strtotime($task->duedate))->diffForHumans() }}</td>
                                    <td>{{ $task->completed == false ? 'pending' : 'completed'}}</td>
                                    <td class="col-sm-3">
                                        <ul class="list-inline col-sm-12">
                                            <li class="col-sm-3">
                                                {!! Form::open(['method' => 'DELETE', 'action' => ['TaskController@restore', $task->slug], 'class' => 'form-horizontal']) !!}
                                                    @include('partials.forms.delete', ['submitTextButton' => 'Restore'])
                                                {!! Form::close() !!}
                                            </li>
                                            {{-- <li class="col-sm-3">
                                                {!! Form::open(['method' => 'DELETE', 'action' => ['TaskController@deleteforever', $project->slug, $task->slug], 'class' => 'form-horizontal']) !!}
                                                    @include('partials.forms.delete', ['submitTextButton' => 'Delete'])
                                                {!! Form::close() !!}
                                            </li> --}}
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            @else
                <p>Sorry, no trashed projects found today, go back to <a href="{{ url('Projects') }}" class="" >projects.</a></p>
            @endif
        </div>
    </div>
</div>

@stop