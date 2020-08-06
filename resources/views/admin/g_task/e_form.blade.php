<div class="col s12 m12 l12">

		<div class="row">



@if(isset($data) && $data->id)



@foreach($inv_gtasks as $inv_gtask)



@php($uid = rand(11,999))



<div class="row" id="prev_select_field_{{ $uid }}">

    <div class="input-field col s12 l5">


    	<i class="fa fa-building prefix"></i>



    	@if($inv_gtask->branches)

        <input type="text" value="All Branches" readonly>

    	@else
        
        <input type="text" value="{{ $branch->find($inv_gtask->branch_id)->name }}" readonly>

    	@endif

        <label for="branch_id_{{ $uid }}">Branch Name</label>

    </div>

    

    <div class="input-field col s12 l6">


    	<i class="fa fa-book prefix"></i>



    	@if($inv_gtask->subjects)

        <input type="text" value="All Subjects" readonly>

    	@else
        
        <input type="text" value="{{ $subject->find($inv_gtask->subject_id)->name }}" readonly>

    	@endif

        <label for="subject_id_{{ $uid }}">Subject Name</label>

    </div>



    <div class="input-field col s1">

        <a href="javascript:void(0);" style="color:red" onclick="Prev_Remove({{ $inv_gtask->id }})"><i class="fa fa-trash fa-2x"></i></a>

    </div>

</div>


@endforeach



@endif


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