@extends('admin.layout.main')

@section('title') Global Task Trash @endsection



@section('content')

<div class="container">

    <div class="section">

        @section('button')

       <a href="{{ Asset($link.'add') }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px">Add New</a>

        <a href="{{ Asset($link) }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px;margin-right:5px;">List</a>

        @endsection


        <div id="striped-table">

            <div class="row">

                <div class="col s12 m12 l12">

                    <table class="striped" >

                        <thead>

                            <tr>

                                <th> Created By </th>

                                <th style="text-align: center;">Assigned to</th>

                                <th style="text-align: center;">Task Name</th>

                                <th style="text-align: center;">Start</th>

                                <th style="text-align: center;">End</th>

                                <th style="text-align: center;"> Options </th>


                            </tr>

                        </thead>

                        <tbody>

                            @foreach($data as $task)

                            <tr>


                                @if($task->admin_id != null)

                                <td width="15%">  {{$admin->find($task->admin_id)->name}}  </td>

                                @elseif($task->teacher_id != null)

                                <td width="15%"> {{$teacher->find($task->teacher_id)->name}}  </td>

                                @else

                                <td width="15%"> N/A </td>

                                @endif



                               @if($task->task_for == 'Students')

                                <td width="15%" style="text-align: center;">All Students</td>

                                @elseif($task->task_for == 'Teachers')

                                <td width="15%" style="text-align: center;">All Teachers</td>

                                @else

                                <td width="15%" style="text-align: center;">N/A</td>

                                @endif


                                <td width="20%" style="text-align: center;">{{$task->task_name}}</td>

                                <td style="text-align: center;" width="15%">{{$task->start_date}}</td>


                                <td width="15%" style="text-align: center;">{{$task->end_date}}</td>

                                <td width="20%" style="text-align: center;">

                                    

                                    <form action="{{ Asset($link.'restore/'.$task->id) }}" method="POST" id="restore_form_{{ $task->id }}" class="form-inline">

                                        @csrf
                                        @method('PATCH')

                                        <button type="button" class="btn cyan tooltipped " data-position="top" data-delay="50" data-tooltip="Restore This Entry" style="padding:0px 10px" onclick="confirmAlert('restore',this)"><i class="fa fa-undo"></i></button>

                                    </form>

                                    <form action="{{ Asset($link.'destroy_permanent/'.$task->id) }}" method="POST" id="delete_form_{{ $task->id }}" class="form-inline">

                                        @csrf

                                        @method('DELETE')

                                        <button type="button" class="btn red tooltipped " data-position="top" data-delay="50" data-tooltip="Delete This Entry" style="padding:0px 10px" onclick="confirmAlert('destroy_permanent',this)"><i class="mdi-content-clear"></i></button>

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