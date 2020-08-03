@extends('admin.layout.main')

@section('title') Manage Student Tasks @endsection



@section('content')

<div class="container">

    <div class="section">

        @section('button')

       <a href="{{ Asset($link.'add') }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px">Add New</a>

        <a href="{{ Asset($link.'trash') }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px;margin-right:5px;">View Trash</a>

        @endsection


         <div class="row">

        <div class="col s12 m12 l12">

          <form action="{{ Asset($link.'search') }}" method="GET" id="search_form" class="col s12">


                        <div class="input-field col s12 l5">

                                <i class="fa fa-calendar prefix"></i>

                                {!! Form::date('from', null,['id' => 'from','required' => 'required', 'class' => 'datepicker' ]) !!}

                                <label for="from">Deadline From </label>

                        </div>


                        <div class="input-field col s12 l5">

                                <i class="fa fa-calendar prefix"></i>

                                {!! Form::date('to', null,['id' => 'to','required' => 'required', 'class' => 'datepicker' ]) !!}

                                <label for="to">Deadline To </label>


                        </div>

            

                        <div class="input-field col s2 l2">

                            <button class="btn green waves-effect waves-light" type="submit" name="action">Search <i class="fa fa-search left"></i></button>

                        </div>
            </form>


        </div>
        </div>

        <br/>


        <div id="striped-table">

            <div class="row">

                <div class="col s12 m12 l12">

                    <table class="striped" >

                        <thead>

                            <tr>

                                <th>Student Name</th>

                                <th style="text-align: center;">Task Name</th>

                                <th style="text-align: center;">Start</th>

                                <th style="text-align: center;">Deadline</th>

                                <th style="text-align: center;">Priority </th>

                                <th style="text-align: center;"> Options </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($data as $task)

                            <tr class="card-panel">

                                <td width="15%" style="padding-left: 17px;">{{ $student->find($task->asg_student_id)->name }}</td>

                                <td width="20%" style="text-align: center;">{{$task->task_name}}</td>

                                <td style="text-align: center;" width="15%">{{$task->start_date}}</td>


                                <td width="15%" style="text-align: center;">{{$task->end_date}}</td>


                                 @if($task->priority == 'High')

                                <td width="15%" style="color: red; text-align: center;"> High </td>

                                @elseif($task->priority == 'Average' )

                                <td width="15%" style="color: green; text-align: center;"> Average  </td>

                                @else

                                <td width="15%"  style="color: orange; text-align: center;"> Low </td>

                                @endif


                                <td width="20%" style="text-align: center;">

                                    

                                    <a href="{{ Asset($link.$task->id.'/edit') }}" class="btn green tooltipped " data-position="top" data-delay="50" data-tooltip="Edit This Entry" style="padding:0px 10px"><i class="mdi-editor-mode-edit"></i></a>


                                    <a href="{{ Asset($link.$task->id.'/extend') }}" class="btn cyan tooltipped " data-position="top" data-delay="50" data-tooltip="Extend This Entry" style="padding:0px 10px"><i class="fa fa-expand"></i></a>


                                    <form action="{{ Asset($link.'destroy/'.$task->id) }}" method="POST" id="delete_form_{{ $task->id }}" class="form-inline">

                                        @csrf

                                        @method('PATCH')

                                        <button type="button" class="btn red tooltipped " data-position="top" data-delay="50" data-tooltip="Delete This Entry" style="padding:0px 10px" onclick="confirmAlert('destroy',this)"><i class="mdi-content-clear"></i></button>

                                    </form>

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