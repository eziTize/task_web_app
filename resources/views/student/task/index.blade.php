@extends('student.layout.main')

@section('title') Your Tasks @endsection



@section('content')

<div class="container">

    <div class="section">


        <div id="striped-table">

            <div class="row">

                <div class="col s12 m12 l12">

                    <table class="striped" >

                        <thead>

                            <tr>

                                <th>Assigned by</th>

                                <th style="text-align: center;">Task Name</th>

                                <th style="text-align: center;">Start</th>

                                <th style="text-align: center;">End</th>

                                <th style="text-align: center;">Priority</th>

                                <th style="text-align: center;"> Attach Proof </th>

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

                                    <a href="{{ Asset($link.$task->id.'/send-proof') }}" class="btn cyan tooltipped " data-position="top" data-delay="50" data-tooltip="Attach Completion Proof" style="padding:0px 10px"><i class="fa fa-paperclip"></i></a>


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