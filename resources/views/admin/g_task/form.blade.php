<div class="col s12 m12 l12">

		<div class="row">

			@include('admin.g_task.select_field')

			<span id="select_field"></span>


			<br>

				<div style="margin-left:10px">

					<button type="button" class="btn green tooltipped" onClick="addSelectField();" data-position="right" data-delay="50" data-tooltip="Add More"><i class="fa fa-plus"></i></button>

				</div>

			<br>


		</div>

</div>

	


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


@section('js')

<script>

	function addSelectField(){

		$("<div>").load("{{ Asset(env('admin').'/g-task/addSelectField') }}", function(){

			$("#select_field").append($(this).html());

		});

	}



	function Remove(id){

		$(id).remove();

	}



	function Prev_Remove(id){

		swal({

        	title: "Are you sure?",

        	text: "Your data will be deleted!",

        	type: "warning",

        	showCancelButton: true,

        	confirmButtonColor: '#DD6B55',

        	confirmButtonText: "Yes, delete it!",

        	closeOnConfirm: false

        }, function(){

        	swal("Deleted!", "Your data has been deleted!", "success");

			window.location.href = "{{ Asset(env('admin').'/g-task/deleteSelectField') }}/"+id;

        });

	}

</script>

@endsection