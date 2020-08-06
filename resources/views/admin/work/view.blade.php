@extends('admin.layout.main')
@section('title') View Work Details @endsection

@section('content')
<div class="container">
    <div class="section">
        @section('button')
        <a href="{{ url()->previous() }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px">Back</a>
        @endsection
        
        <div class="row">
            <div class="col s12 m12 l12">
                @include('admin.work.v_form',['id' => $id])
            </div>
        </div>
    </div>
</div>
@endsection