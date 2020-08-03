<div class="row" style="padding-left: 25px;">


	@include('teacher.work.log_field')

	<span id="log_field"> </span>

	<br>

	<div style="margin-left: 20px">

		<button type="button" class="btn cyan" onClick="addLog();"> <i class="fa fa-plus"> </i>
		</button>

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

	function addLog(){

		$("<div>").load("{{ Asset(env('teacher').'/work-log/addLog') }}", function(){

			$("#log_field").append($(this).html());

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

			window.location.href = "{{ Asset(env('teacher').'/work-log/delete_Log') }}/"+id;

        });

	}

	

</script>

@endsection