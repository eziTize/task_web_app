@extends('teacher.layout.main')
@section('title') Assign New Student Task @endsection

@section('content')
<div class="container">
    <div class="section">
        @section('button')
        <a href="{{ Asset($link) }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px">Back</a>
        @endsection
        
        <div class="row">
            <div class="col s12 m12 l12">
                {!! Form::model($data, ['url' => [env('teacher').'/student-task/store'],'files' => true,'autocomplete' => 'off'],['class' => 'col s12']) !!}
                @include('teacher.task.student.form')
            </div>
        </div>
    </div>
</div>
@endsection