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

                                <th style="text-align: center;"> Status </th>

                                <th style="text-align: center;"> Options </th>


                            </tr>

                        </thead>

                        <tbody>

                            @foreach($data as $task)


                            <tr class="card-panel">


                               

                            <td width="12%" style="padding-left: 17px">{{ $teacher->find($task->teacher_id)->name }}</td>

                            <td width="12%" style="text-align: center;">{{ $teacher->find($task->asg_teacher_id)->name }}</td>




                                <td style="text-align: center;" width="16%"> {{$task->task_name}} </td>


                                <td width="15%" style="text-align: center;">{{$task->start_date}}</td>

                                <td width="15%" style="text-align: center;">{{$task->end_date}}</td>


                                @if($task->approved == 'Y')

                                <td width="10%" style="color: green; text-align: center;"> Assigned </td>

                                @elseif($task->approved == 'N' )

                                <td width="10%" style="color: red; text-align: center;"> Rejected </td>

                                @elseif($task->approved == 'P' )

                                <td width="10%" style="color: orange; text-align: center;"> Pending </td>

                                @endif


                                <td width="20%" style="text-align: center;">


                                    <form action="{{ Asset($link.$task->id.'/approve') }}" method="POST" id="assign_form_{{ $task->id }}" class="form-inline">

                                        @csrf

                                        @method('PATCH')

                                        <button type="button" class="btn green tooltipped " data-position="top" data-delay="50" data-tooltip="Approve This Request" style="padding:0px 10px" onclick="confirmAlert('approve',this)"><i class="fa fa-check"></i></button>

                                    </form>



                                    @if($task->approved == 'P')
                                    <form action="{{ Asset($link.$task->id.'/reject') }}" method="POST" id="remove_form_{{ $task->id }}" class="form-inline">

                                        @csrf

                                        @method('PATCH')

                                        <button type="button" class="btn red tooltipped " data-position="top" data-delay="50" data-tooltip="Reject This Request" style="padding:0px 10px" onclick="confirmAlert('reject',this)"><i class="mdi-content-clear"></i></button>

                                    </form>
                                    @endif

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