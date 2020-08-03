@extends('admin.layout.main')
@section('title') Add New Team Member @endsection

@section('content')
<div class="container">
    <div class="section">
        @section('button')
        <a href="{{ Asset($link) }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px">Back</a>
        @endsection
        
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card-panel">
                    <div class="row">
                        {!! Form::model($data, ['url' => [env('admin').'/team-members'],'files' => true,'autocomplete' => 'off'],['class' => 'col s12']) !!}
                        <h4 class="header2">Create New Team Member Here</h4>
                        @include('admin.users.team-members.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection