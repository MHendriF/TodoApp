@extends('partials.bodywithoutsidenav')

@section('title', 'Project | 24 Hours')

@section('content')

<div class="container">
    <div class="row text-left">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-70">
            <h2>Test <span class="small pull-right">{{$today}} | {{$currenttime}}</span></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="pull-right">
                <a href="#createprojects" class="btn btn-sm btn-green" data-toggle="modal"><i class="fa fa-plus"></i>&nbsp;New Project</a>
            </div>
        </div>

        <form method="post" action="{{ url('test') }}" class="form-horizontal form-label-left">
            {!! csrf_field() !!}
            <div class="form-group">
                 <div class="input-group">
                    <div class="input-group-addon">Name</div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="name" class="form-control col-md-7 col-xs-12" placeholder="Name" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                 <div class="input-group">
                    <div class="input-group-addon">Slug</div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="slug" class="form-control col-md-7 col-xs-12" placeholder="Slug" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">Duedate</div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="duedate" id="datepicker" class="form-control col-md-7 col-xs-12" placeholder="Duedate" />
                    </div>
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-5">
                    <button type="reset" class="btn btn-primary">Cancel</button>
                    <button id="send" type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>    
        </form>

    </div>
</div>


@stop