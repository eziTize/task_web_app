@extends('student.layout.main')
@section('title') Dashboard @endsection

@section('content')
<div class="container">
    <div class="section">


        <div class="fixed-action-btn" style="bottom: 50px; right: 19px;">

    </div>            
</div>
@endsection

@section('js')

<script type="text/javascript" src="{{ Asset('js/plugins/chartist-js/chartist.min.js') }}"></script>
<script type="text/javascript" src="{{ Asset('js/plugins/chartjs/chart.min.js') }}"></script>
<script type="text/javascript" src="{{ Asset('js/plugins/chartjs/chart-script.js') }}"></script>

@endsection