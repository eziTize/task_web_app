<div class="row">

	<div class="input-field col s12 112">



		<i class="mdi-social-person prefix"></i>


		<select style="padding-left: 40px" class="browser-default" name="asg_teacher_id" required>


			@if($data->asg_teacher_id)

			<option value="{{$data->asg_teacher_id}}"> {{$teacher->find($data->asg_teacher_id)->name}} </option>

			@else
				<option value="">Select Team Member *</option>

			@endif


			@foreach($teacher as $teachers)

				@if($teachers->id != $data->asg_teacher_id && $teachers->id != $teacher_id)

					<option value="{{ $teachers->id }}">

					{{ $teachers->name }}, ID: {{ $teachers->id }}

					</option>

				@endif

			@endforeach


		</select>

	</div>

</div>

<br>

<div class="row">

	<div class="input-field col s12 l6">

		<i class="fa fa-file-text-o prefix"></i>

		{!! Form::text('task_name', null,['id' => 'task_name','required' => 'required']) !!}

		<label for="task_name"> Task Name *</label>

	</div>


	<div class="input-field col s12 l6">

		<i class="fa fa-flag prefix"></i>

		{!! Form::text('task_desc',null,['id' => 'task_desc', 'required' => 'required']) !!}

		<label for="task_desc">Task Description *</label>

	</div>

	<div class="input-field col s12 l6">

		<i class="fa fa-calendar prefix"></i>

		{!! Form::date('start_date',null,['id' => 'start_date','required' => 'required', 'class' => 'datepicker' ]) !!}

        <label for="start_date">Start Date *</label>


	</div>


	<div class="input-field col s12 l6">

		<i class="fa fa-calendar prefix"></i>

		{!! Form::date('end_date',null,['id' => 'end_date','required' => 'required', 'class' => 'datepicker' ]) !!}

        <label for="end_date">End Date *</label>


	</div>

	
</div>


 <div class="row">

                            <div class="input-field col s12 l12">

                                {!! Form::select('priority',['High' => 'High', 'Average' => 'Average', 'Low' => 'Low' ], $data->grade) !!}

                            </div>

    </div>


<div class="row">

	

	<div class="input-field col s12">

		<div class="input-field col s12">

			<button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit <i class="mdi-content-send right"></i></button>

		</div>

	</div>

</div>