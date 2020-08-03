@extends('admin.layout.main')

@section('title') Task Extend Requests @endsection



@section('content')

<div class="container">

    <div class="section">

        <div id="striped-table">

            <div class="row">

                <div class="col s12 m12 l12">

                    <table class="striped" >

                        <thead>

                            <tr>

                                <th>Requested By</th>

                                <th style="text-align: center;">Task Name</th>

                                <th style="text-align: center;">Deadline </th>

                                <th style="text-align: center;"> Req. Date </th>

                                <th style="text-align: center;"> Extended </th>

                                <th style="text-align: center;"> Options </th>


                            </tr>

                        </thead>

                        <tbody>

                            @foreach($data as $u_task)


                            <tr class="card-panel">


                                @if($u_task->student_id == null)

                                <td width="15%" style="padding-left: 17px">{{ $teacher->find($u_task->teacher_id)->name }}</td>

                                @elseif($u_task->teacher_id == null)

                                <td width="15%" style="padding-left: 17px">{{ $student->find($u_task->student_id)->name }}</td>

                                @else

                                <td width="15%" style="padding-left: 17px">N/A</td>

                                @endif



                                @if($u_task->type == 'Task')

                                <td width="20%" style="text-align: center;">{{ $task->find($u_task->task_id)->task_name }}</td>


                                @elseif($u_task->type == 'G-Task')

                                <td width="20%" style="text-align: center;" >{{ $gtask->find($u_task->gtask_id)->task_name }}</td>

                                @else


                                <td width="20%" style="text-align: center;" > N/A </td>


                                @endif


                                <td style="text-align: center;" width="20%">


                                    @if($u_task->req_date)


                                    {{$u_task->req_date}}

                                    @else

                                    {{$u_task->deadline}}

                                    @endif


                                </td>


                                <td width="15%" style="text-align: center;">{{$u_task->ex_date}}</td>

                                <td width="15%" style="text-align: center;">{{$u_task->req_no}} Time(s)</td>



                                <td width="20%" style="text-align: center;">


                                    <form action="{{ Asset($link.$u_task->id.'/extend') }}" method="POST" id="extend_form_{{ $u_task->id }}" class="form-inline">

                                        @csrf

                                        @method('PATCH')

                                        <button type="button" class="btn green tooltipped " data-position="top" data-delay="50" data-tooltip="Approve This Request" style="padding:0px 10px" onclick="confirmAlert('extend',this)"><i class="fa fa-check"></i></button>

                                    </form>


                                    <form action="{{ Asset($link.$u_task->id.'/remove') }}" method="POST" id="remove_form_{{ $u_task->id }}" class="form-inline">

                                        @csrf

                                        @method('PATCH')

                                        <button type="button" class="btn red tooltipped " data-position="top" data-delay="50" data-tooltip="Remove This Request" style="padding:0px 10px" onclick="confirmAlert('remove',this)"><i class="mdi-content-clear"></i></button>

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