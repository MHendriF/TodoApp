<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">Name</div>
		{!! Form::text('name', Input::old('name'), ['class' => 'form-control', 'placeholder' => 'Project Name']) !!}
	</div>
</div>

<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">Description</div>
		{!! Form::textarea('desc', Input::old('desc'), ['rows' => '3', 'cols' => '3', 'class' => 'form-control', 'placeholder' => 'Project Description']) !!}
	</div>
</div>

<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">Due date</div>
		{!! Form::text('duedate', Input::old('duedate'), ['class' => 'form-control datepicker', 'placeholder' => 'Project due date']) !!}
	</div>
</div>