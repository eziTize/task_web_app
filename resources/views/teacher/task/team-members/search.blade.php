@extends('teacher.layout.main')

@section('title') Search Team Member Tasks @endsection



@section('content')

<div class="container">

    <div class="section">

        @section('button')

        <a href="{{ Asset($link) }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px;">Back</a>
       
        @endsection


         <div class="row" style=" padding-bottom: 25px">

        <div class="col s12 m12 l12">


                <form action="{{ Asset($link.'search') }}" method="GET" id="search_form" class="col s12">

                        <div class="input-field col s12 l5">

                                <i class="fa fa-calendar prefix"></i>

                                {!! Form::date('from', null,['id' => 'from','required' => 'required', 'class' => 'datepicker' ]) !!}

                                <label for="from">From Deadline </label>


                        </div>


                                <div class="input-field col s12 l5">

                                    <i class="fa fa-calendar prefix"></i>

                                    {!! Form::date('to', null,['id' => 'to','required' => 'required', 'class' => 'datepicker' ]) !!}

                                    <label for="to">To Deadline </label>


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

                                <th>Member Name</th>

                                <th style="text-align: center;">Task Name</th>

                                <th style="text-align: center;">Start</th>

                                <th style="text-align: center;">Deadline</th>

                                <th style="text-align: center;">Priority</th>

                                <th style="text-align: center;">Status</th>

                                <th style="text-align: center;"> Options </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($data as $task)

                            <tr class="card-panel">

                                <td width="15%" style="padding-left: 17px">{{ $teacher->find($task->asg_teacher_id)->name }}</td>

                                <td width="20%" style="text-align: center;">{{$task->task_name}}</td>

                                <td style="text-align: center;" width="15%">{{$task->start_date}}</td>


                                <td width="15%" style="text-align: center;">{{$task->end_date}}</td>


                                @if($task->priority == 'High')

                                <td width="10%" style="color: red; text-align: center;"> High </td>

                                @elseif($task->priority == 'Average' )

                                <td width="10%" style="color: green; text-align: center;"> Average  </td>

                                @else

                                <td width="10%"  style="color: orange; text-align: center;"> Low </td>

                                @endif


                                 @if($task->approved == 'Y')

                                <td width="10%" style="color: green; text-align: center;"> Assigned </td>

                                @elseif($task->approved == 'N' )

                                <td width="10%" style="color: orange; text-align: center;"> Pending </td>


                                @endif


                                <td width="25%" style="text-align: center;">

                                    

                                    <a href="{{ Asset($link.$task->id.'/edit') }}" class="btn green tooltipped " data-position="top" data-delay="50" data-tooltip="Edit This Entry" style="padding:0px 10px"><i class="mdi-editor-mode-edit"></i></a>


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