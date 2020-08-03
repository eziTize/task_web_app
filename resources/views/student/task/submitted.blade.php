

@extends('student.layout.main')


@section('title') Submit proof (Only: jpg/jpeg/png/pdf/doc/docx) @endsection


@section('content')

<div class="container">

    <div class="section">

    	@section('button')

        <a href="{{ Asset($link) }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px">Back</a>

        @endsection

        <div class="row">


           <h5> <center> You Have Already Submitted The Proof for this Task </center> </h5>


        </div>


    </div>

</div>

@endsection