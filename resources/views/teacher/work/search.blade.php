@extends('teacher.layout.main')

@section('title') Search Work Log @endsection



@section('content')

<div class="container">

    <div class="section">

        @section('button')

       <a href="{{ Asset($link) }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px">Back</a>

        @endsection


        <div class="row" style=" padding-bottom: 25px">

        <div class="col s12 m12 l12">


         {!! Form::model($data, ['method' => 'GET','url' => [env('teacher').'/work-log/search'],'files' => true,'autocomplete' => 'off'],['class' => 'col s12']) !!}
                        <div class="input-field col s12 l5">

                                <i class="fa fa-calendar prefix"></i>

                                {!! Form::date('from', null,['id' => 'from','required' => 'required', 'class' => 'datepicker' ]) !!}

                                <label for="from">From </label>


                        </div>


                                <div class="input-field col s12 l5">

                                    <i class="fa fa-calendar prefix"></i>

                                    {!! Form::date('to', null,['id' => 'to','required' => 'required', 'class' => 'datepicker' ]) !!}

                                    <label for="to">To </label>


                                </div>

            

                            <div class="input-field col s2 l2">

                        <button class="btn green waves-effect waves-light" type="submit" name="action">Search <i class="fa fa-search left"></i></button>

                            </div>


        </div>
        </div>

    @if($from && $to )

    @if($from == $to)

            <h6 style=" padding-bottom: 25px; font-size: 20px"><i class="fa fa-calendar-check-o prefix"></i> Work Log of {{$from}}: </h6>

    @else
            <h6 style=" padding-bottom: 25px; font-size: 20px"><i class="fa fa-calendar-check-o prefix"></i> Work Log from {{$from}} to {{ $to }}: </h6>
    @endif

    @endif
    
        @foreach($data as $work)

        <div class="card-panel" style="margin-bottom: 17px; margin-left: 20px;">

            <div class="row">

                <div class="input-field col s12 l5">

                    <i class="fa fa-file-text-o prefix"></i>


                    <input type="text" value="{{ $work->name }}" readonly>

                    <label for="name">Work Name</label>

                </div>


                <div class="input-field col s12 l6">

                    <i class="fa fa-info prefix"></i>


                    <input type="text" value="{{ $work->desc }}" readonly>

                    <label for="desc">Description</label>

                </div>


                <div class="input-field col s12 l3">

                    
                    <i class="fa fa-calendar prefix"></i>


                    <input type="date" value="{{ $work->start_date }}" readonly>

                </div>



                <div class="input-field col s12 l4">


                    <i class="fa fa-clock-o prefix"></i>


                    <input type="time" value="{{ $work->started_at }}" readonly>


                </div>


                <div class="input-field col s12 l4">

                    <i class="fa fa-clock-o prefix"></i>


                    <input type="time" value="{{ $work->ended_at }}" readonly>


                </div>



                <div class="input-field col s1">

                    <a class="btn green tooltipped" href="{{ Asset($link.$work->id.'/edit') }}" style="padding:0px 10px" data-position="top" data-delay="50" data-tooltip="Edit This Entry"><i class="fa fa-edit fa-2x"></i></a>

                </div>


            </div>

        </div>        

        @endforeach


    </div>

</div>


@endsection



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