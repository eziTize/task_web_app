@extends('admin.layout.main')
@section('title') Check Student Reports @endsection

@section('content')
<div class="container">
    <div class="section">

        <div class="row" style=" padding-bottom: 25px">

        <div class="col s12 m12 l12">


           <form action="{{ Asset($link) }}" method="GET" id="search_form" class="col s12">



                    <div class="input-field col s12 l10">

                     <i class="fa fa-user prefix"></i>

                        <select style="padding-left: 40px" class="browser-default" name="user_id" required>

                            <option value="">Select Student </option>


                                @foreach($students as $student)

                                        <option value="{{ $student->id }}">

                                        {{ $student->name }}, ID: {{ $student->id }}

                                        </option>

                                @endforeach


                            </select>

                        </div>

            

                    <div class="input-field col s2 l2">

                        <button class="btn green waves-effect waves-light" type="submit" name="action">Search <i class="fa fa-search left"></i></button>

                    </div>
            </form>

        </div>
        </div>

        <div id="striped-table">
            <div class="row">
                <div class="col s12 m12 l12">
                    <table class="striped" >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th style="text-align: center;">Student Name</th>
                                <th style="text-align: center;">Email</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;">Check Report</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $student)
                            <tr class="card-panel">
                                <td width="10%" style="padding-left: 17px;"> {{ $student->id }} </td>
                                <td width="20%" style="text-align: center;">{{ $student->name }}</td>
                                <td width="25%" style="text-align: center;">{{ $student->email }}</td>
                                <td width="20%" style="text-align: center;">{!! IMS::status($student->status) !!}</td>
                                <td width="25%" style="text-align: center;">
                                    <a href="{{ Asset($link.$student->id) }}" class="btn green tooltipped " data-position="top" data-delay="50" data-tooltip="Check Report For This Student" style="padding:0px 10px"><i class="fa fa-bar-chart"></i></a>
                            
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection