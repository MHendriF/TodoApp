<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">Name</div>
		{!! Form::text('name', 'name', ['class' => 'form-control', 'placeholder' => 'Task Name']) !!}
	</div>
</div>

<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">Description</div>
		{!! Form::textarea('desc', 'desc', ['rows' => '3', 'cols' => '3', 'class' => 'form-control', 'placeholder' => 'Task Description']) !!}
	</div>
</div>

<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">Due date</div>
		{!! Form::text('duedate', 'duedate', ['class' => 'form-control datepicker', 'placeholder' => 'Task due date']) !!}
	</div>
</div>