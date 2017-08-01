@extends('partials.bodywithsidenav')

@section('title', 'Trashed Project | 24 Hours')

@section('content')

<div class="container">
    <div class="row text-left">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-70">
            <h2>Trashed Projects <span class="small pull-right">{{$today}} | {{$currenttime}}</span></h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('projects') }}">Projects</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="pull-right">
                <a href="{{ url('projects') }}" class="btn btn-sm btn-green" data-toggle="modal"><i class="fa fa-plus"></i>&nbsp;Back to project</a>
                @if(count($projectsTrashed))
                    <a href="{{ url('projects/restoreall') }}" class="btn btn-sm btn-green"><i class="fa fa-check"></i>&nbsp;Restore all&nbsp;<span class="badge">{{ count($projectsTrashed) }}</span></a>
                @endif
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @if(count($projectsTrashed))
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
                        @foreach($projectsTrashed as $project)
                            <tbody>
                                <tr>
                                    <td>{{ $project->id }}</td>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->user->name }}</td>
                                    <td>{{ count($project->tasks()->get()) }}</td>
                                    <td>{{ $project->created_at->diffForHumans() }}</td>
                                    <td>{{ $project->updated_at->diffForHumans() }}</td>
                                    <td>{{ Carbon\Carbon::createFromTimestamp(strtotime($project->duedate))->diffForHumans() }}</td>
                                    <td>{{ $project->completed == false ? 'pending' : 'completed'}}</td>
                                    <td class="col-sm-3">
                                        <ul class="list-inline col-sm-12">
                                            <li class="col-sm-3">
                                                {!! Form::open(['method' => 'DELETE', 'action' => ['ProjectController@restore', $project->slug], 'class' => 'form-horizontal']) !!}
                                                    @include('partials.forms.delete', ['submitTextButton' => 'Restore'])
                                                {!! Form::close() !!}
                                            </li>
                                            <li class="col-sm-3">
                                                {!! Form::open(['method' => 'DELETE', 'action' => ['ProjectController@deleteforever', $project->slug], 'class' => 'form-horizontal']) !!}
                                                    @include('partials.forms.delete', ['submitTextButton' => 'Delete'])
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
                <p>Sorry, no trashed projects found today, go back to <a href="{{ url('Projects') }}" class="" >projects.</a></p>
            @endif
        </div>
    </div>
</div>

@stop