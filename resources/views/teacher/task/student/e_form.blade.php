<div class="row">

	<div class="input-field col s12 112">



		<i class="mdi-social-person prefix"></i>


		<select style="padding-left: 40px" class="browser-default" name="asg_student_id" required>


			@if($data->asg_student_id)

			<option value="{{$data->asg_student_id}}"> {{$student->find($data->asg_student_id)->name}} </option>

			@else
				<option value="">Select Student *</option>

			@endif


			@foreach($student as $students)

				@if($students->id != $data->asg_student_id )

					<option value="{{ $students->id }}">

					{{ $students->name }}, ID: {{ $students->id }}

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