<!-- Modal -->
<div class="modal fade editmodalwindow" id="edittasks" role="dialog">
  	<div class="modal-dialog">
    	<div class="modal-content">
    		{!! Form::model($task, ['method' => 'PATCH', 'action' => ['ProjectController@update', $task->id], 'class' => 'form-horizontal']) !!}
    			
	      		<div class="modal-header">
	      			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	      			<h4 class="modal-title">Edit Task</h4>
	      			<p>Update URL: <span id="form-url"></span></p>
		      	</div>

		      	<div class="modal-body">
		      		@include('pages.projects.forms.edit.task')
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