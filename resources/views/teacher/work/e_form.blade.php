<div class="card-panel" style="margin-left: 16px;">

<div class="row" style="padding-left: 20px">

	   <div class="input-field col s12 l11">

        <i class="fa fa-file-text-o prefix"></i>


        {!! Form::text('name',null,['id' => 'name', 'required' => 'required']) !!}

        <label for="name">Work Name *</label>

    </div>


    <div class="input-field col s12 l11">

        <i class="fa fa-edit prefix"></i>


        {!! Form::textarea('desc',null,['id' => 'desc', 'class' => 'materialize-textarea', 'required' => 'required']) !!}

        <label for="desc">Description *</label>

    </div>


    <div class="input-field col s12 l3">

        <i class="fa fa-calendar prefix"></i>

        {!! Form::date('start_date',null,['id' => 'start_date', 'required' => 'required']) !!}


    </div>


    <div class="input-field col s12 l4">

    <i class="fa fa-clock-o prefix"></i>

        {!! Form::time('started_at',null,['id' => 'started_at', 'required' => 'required']) !!}


    </div>


    <div class="input-field col s12 l4">

    <i class="fa fa-clock-o prefix"></i>

        {!! Form::time('ended_at',null,['id' => 'ended_at', 'required' => 'required']) !!}


    </div>

  </div>

<div class="row">

	<div class="input-field col s12">

		<div class="input-field col s12">

			<button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit <i class="mdi-content-send right"></i></button>

		</div>

	</div>

</div>

</div>

@section('js')

<!-- Script for date limitations -->

<script>

$(function(){
    var dtToday = new Date();
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();

    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();

    var maxDate = year + '-' + month + '-' + day;  


   var yesterday = new Date();
    yesterday.setDate(yesterday.getDate() - 1);

    var ymonth = yesterday.getMonth() + 1;
    var yday = yesterday.getDate();
    var yyear = yesterday.getFullYear();

    if(ymonth < 10)
        ymonth = '0' + ymonth.toString();
    if(yday < 10)
        yday = '0' + yday.toString();


    var minDate = yyear + '-' + ymonth + '-' + yday;


    $('#start_date').attr('max', maxDate);
    $('#start_date').attr('min', minDate);
});

</script>

<!-- End Script -->

@endsection

