@extends('admin.layout.main')

@section('title') Task Assign Requests @endsection



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

                                <th style="text-align: center;">Assigned To</th>

                                <th style="text-align: center;"> Task Name </th>

                                <th style="text-align: center;">Start Date </th>

                                <th style="text-align: center;"> Deadline </th>

                                <th style="text-align: center;"> Options </th>


                            </tr>

                        </thead>

                        <tbody>

                            @foreach($data as $task)


                            <tr class="card-panel">


                               

                            <td width="15%" style="padding-left: 17px">{{ $teacher->find($task->teacher_id)->name }}</td>

                            <td width="15%" style="text-align: center;">{{ $teacher->find($task->asg_teacher_id)->name }}</td>




                                <td style="text-align: center;" width="20%"> {{$task->task_name}} </td>


                                <td width="15%" style="text-align: center;">{{$task->start_date}}</td>

                                <td width="15%" style="text-align: center;">{{$task->end_date}}</td>



                                <td width="20%" style="text-align: center;">


                                    <form action="{{ Asset($link.$task->id.'/approve') }}" method="POST" id="assign_form_{{ $task->id }}" class="form-inline">

                                        @csrf

                                        @method('PATCH')

                                        <button type="button" class="btn green tooltipped " data-position="top" data-delay="50" data-tooltip="Approve This Request" style="padding:0px 10px" onclick="confirmAlert('approve',this)"><i class="fa fa-check"></i></button>

                                    </form>


                                    <form action="{{ Asset($link.$task->id.'/remove') }}" method="POST" id="remove_form_{{ $task->id }}" class="form-inline">

                                        @csrf

                                        @method('DELETE')

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