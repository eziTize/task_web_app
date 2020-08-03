<div class="row">

	<div class="input-field col s12 112">



		<i class="fa fa-users prefix"></i>


		<select style="padding-left: 40px" class="browser-default" name="task_for" required>


			@if($data->task_for)

			<option value="{{$data->task_for}}"> All {{$data->task_for}} </option>

			@else

					<option value="Students">

					All Students

					</option>


					<option value="Teachers">

					All Teachers

					</option>

			@endif



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