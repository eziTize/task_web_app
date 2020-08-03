@extends('teacher.layout.main')


@section('title') Request For Deadline Extention @endsection


@section('content')

<div class="container">

    <div class="section">

    	@section('button')

        <a href="{{ Asset($link) }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px">Back</a>

        @endsection

        <div class="row">


           <h5> <center> Your last request is not responded yet! </center> </h5>


           <p> <center> Please wait till admin responds to your last Extend request before requesting again. </center></p>


        </div>


    </div>

</div>

@endsection