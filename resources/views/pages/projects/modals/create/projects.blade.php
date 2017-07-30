<!-- Modal -->
<div class="modal fade" id="createprojects" role="dialog" aria-hidden="true">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
    		{!! Form::open(['url' => 'projects', 'methode' => 'POST', 'action' => 'ProjectController@store', 'class' => 'form-horizontal']) !!}
    			{!! csrf_field() !!}
	      		<div class="modal-header">
	      			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      			<h4 class="modal-title">Add a new project</h4>
		      	</div>
		      	<div class="modal-body">
		      		@include('pages.projects.forms.project')
		      	</div>
		      	<div class="modal-footer">
		      		<a href="#" id="" class="btn btn-cyan submitbutton"><i class="fa fa-flash"></i>&nbsp; {{ $submitTextButton }}</a>
		      		{{-- <button id="send" type="submit" class="btn btn-success">Submit</button> --}}
			      	<div class="success margin-top-20">
			      		@include('errors.errors')
			      	</div>
		      	</div>
		    {!! Form::close() !!}
	    </div>
	</div>
</div>