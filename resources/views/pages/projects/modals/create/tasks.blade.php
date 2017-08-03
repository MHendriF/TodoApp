<!-- Modal -->
<div class="modal fade" id="createtasks" role="dialog">
  	<div class="modal-dialog" >
    	<div class="modal-content">
    	{!! Form::open(['methode' => 'POST', 'action' => ['TaskController@store', $project->id], 'class' => 'form-horizontal']) !!}
	      	<div class="modal-header">
	      		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      		<h4 class="modal-title">Add a new task</h4>
		    </div>
		    <div class="modal-body">
		      	@include('pages.projects.forms.task')
		    </div>
		    <div class="modal-footer">
		     	<a href="#" id="" class="btn btn-cyan submitbutton"><i class="fa fa-save"></i>&nbsp; {{ $submitTextButton }}</a>
		      	{{-- <button id="send" type="submit" class="btn btn-success">Submit</button> --}}
		{!! Form::close() !!}
			    <div class="success margin-top-20">
			     	@include('errors.errors')
			    </div>
		    </div>
	    </div>
	</div>
</div>