@extends('teacher.layout.main')
@section('title') Add Task For All Students @endsection

@section('content')
<div class="container">
    <div class="section">
        @section('button')
        <a href="{{ Asset($link) }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px">List</a>
        @endsection
        
        <div class="row">
            <div class="col s12 m12 l12">
                {!! Form::model($data, ['url' => [env('teacher').'/g-task/store'],'files' => true,'autocomplete' => 'off'],['class' => 'col s12']) !!}
                @include('teacher.g_task.form')
            </div>
        </div>
    </div>
</div>
@endsection