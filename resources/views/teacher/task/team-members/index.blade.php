@extends('teacher.layout.main')

@section('title') Manage Team Member Tasks @endsection



@section('content')

<div class="container">

    <div class="section">

        @section('button')

        <a href="{{ Asset($link.'search') }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px;">Search</a>

        <a href="{{ Asset($link.'add') }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px; margin-right:5px;">Assign New</a>    
           
        @endsection


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

                                <td width="10%" style="color: red; text-align: center;"> Rejected </td>

                                @elseif($task->approved == 'P' )

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