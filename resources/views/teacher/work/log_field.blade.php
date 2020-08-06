



@php($uid = rand(11,999))


<div class="card-panel" id="log_field_{{ $uid }}" style="padding-bottom: 25px">

<div class="row" >

    <div class="input-field col s12 l11">

        <i class="fa fa-file-text-o prefix"></i>


        {!! Form::text('name[]',null,['id' => 'name'.$uid, 'required' => 'required']) !!}

        <label for="name_{{ $uid }}">Work Name *</label>

    </div>


    <div class="input-field col s12 l11">

        <i class="fa fa-edit prefix"></i>


        {!! Form::textarea('desc[]',null,['id' => 'desc'.$uid, 'class' => 'materialize-textarea', 'required' => 'required']) !!}

        <label for="desc_{{ $uid }}">Description *</label>

    </div>


    <div class="input-field col s12 l3">

        <i class="fa fa-calendar prefix"></i>

        {!! Form::date('start_date[]',null,['id' => 'start_date'.$uid, 'required' => 'required', 'class' => 'datepicker']) !!}

    </div>


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


    $('#start_date{{$uid}}').attr('max', maxDate);
    $('#start_date{{$uid}}').attr('min', minDate);
});

</script>

<!-- End Script -->


    <div class="input-field col s12 l4">

    <i class="fa fa-clock-o prefix"></i>

        {!! Form::time('started_at[]',null,['id' => 'started_at'.$uid, 'required' => 'required']) !!}


    </div>


    <div class="input-field col s12 l4">

    <i class="fa fa-clock-o prefix"></i>

        {!! Form::time('ended_at[]',null,['id' => 'ended_at'.$uid, 'required' => 'required']) !!}


    </div>


    <div class="input-field col s1">

        <a href="javascript:void(0);" class="btn red" onclick="Remove(log_field_{{ $uid }})" class="btn red" style="padding:0px 10px"><i class="fa fa-trash fa-2x"></i></a>

    </div>


</div>

</div>