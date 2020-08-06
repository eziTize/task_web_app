@extends('teacher.layout.main')

@section('title') Work Log @endsection



@section('content')

<div class="container">

    <div class="section">

        @section('button')

        <a href="{{ Asset($link.'search') }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px;margin-right:5px;"><i class="fa fa-search" style="padding-right: 10px;"></i> Search</a>

        @endsection

        <h5 style=" padding-bottom: 25px"> <center> <i class="fa fa-calendar prefix"></i> <b> Today's Work Log </b> </center> </h5>


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

        @if($work->start_date == $today )

                <div class="input-field col s1">

                    <a class="btn green tooltipped" href="{{ Asset($link.$work->id.'/edit') }}" style="padding:0px 10px" data-position="top" data-delay="50" data-tooltip="Edit This Entry"><i class="fa fa-edit fa-2x"></i></a>

                </div>
        @endif

            </div>

        </div>        

        @endforeach


        


    </div>
    <div style="margin-bottom: 17px; margin-left: 20px">

 {!! Form::model($data, ['url' => [env('teacher').'/work-log/store'],'files' => true,'autocomplete' => 'off'],['class' => 'col s12']) !!}

    <span id="log_field"> </span>

    <br>

        <button type="button" class="btn cyan tooltipped" onClick="addLog();" data-position="right" data-delay="50" data-tooltip="Add Work"> <i class="fa fa-plus"> </i>
        </button>



</div>

</div>


<div class="row">

    <div class="input-field col s12">

        <div class="input-field col s12">

            <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit <i class="mdi-content-send right"></i></button>

        </div>

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