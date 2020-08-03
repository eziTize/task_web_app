@extends('teacher.layout.main')

@section('title') Your Tasks @endsection



@section('content')

<div class="container">

    <div class="section">

       @section('button')

       <a href="{{ Asset($link.'search') }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px">Search</a>

        @endsection

        <div id="striped-table">

            <div class="row">

                <div class="col s12 m12 l12">

                    <table class="striped" >

                        <thead>

                            <tr>

                                <th>Assigned by</th>

                                <th style="text-align: center;">Task Name</th>

                                <th style="text-align: center;">Start</th>

                                <th style="text-align: center;">Deadline</th>

                                <th style="text-align: center;">Extended</th>

                                <th style="text-align: center;">Priority</th>


                                <th style="text-align: center;"> Attach Proof </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($data as $u_task)


                  @if( $u_task->proof && $u_task->status != 'Denied')

                                <tr class="card-panel">

                                
                            @else

                            @if($u_task->deadline < today()->toDateString())
                                    
                                    @if($u_task->req_date)

                                        @if($u_task->req_date < today()->toDateString())
                                            <tr class="card-panel" style="color: red;">
                                        @else
                                            <tr class="card-panel">
                                        @endif

                                    @else

                                    <tr class="card-panel" style="color: red;">

                                    @endif

                                @else

                                <tr class="card-panel">

                                @endif


                         @endif



                             @if($u_task->type == 'Task')

                            <td width="15%" style="padding-left: 17px">

                                @if($task->find($u_task->task_id)->admin_id)

                                {{ $admin->find($task->find($u_task->task_id)->admin_id)->name }}

                                @else

                                {{ $teacher->find($task->find($u_task->task_id)->teacher_id)->name }}

                                @endif

                            </td>


                            @elseif($u_task->type == 'G-Task')

                            <td width="15%" style="padding-left: 17px" >


                                @if($gtask->find($u_task->gtask_id)->admin_id)

                                {{ $admin->find($gtask->find($u_task->gtask_id)->admin_id)->name }}

                                @else

                                {{ $teacher->find($gtask->find($u_task->gtask_id)->teacher_id)->name }}

                                @endif


                            </td>

                            @else


                            <td width="15%" style="padding-left: 17px"> N/A </td>


                            @endif


                            @if($u_task->type == 'Task')

                            <td width="15%" style="text-align: center;">{{ $task->find($u_task->task_id)->task_name }}</td>


                            @elseif($u_task->type == 'G-Task')

                            <td width="15%" style="text-align: center;" >{{ $gtask->find($u_task->gtask_id)->task_name }}</td>

                            @else


                            <td width="15%" style="text-align: center;" > N/A </td>


                            @endif

                            @if($u_task->type == 'Task')

                            <td width="15%" style="text-align: center;">{{ $task->find($u_task->task_id)->start_date }}</td>
                            <td width="15%" style="text-align: center;">{{ $u_task->deadline }}</td>


                            @elseif($u_task->type == 'G-Task')

                            <td width="15%" style="text-align: center;" >{{ $gtask->find($u_task->gtask_id)->start_date }}</td>
                            <td width="15%" style="text-align: center;" >{{ $u_task->deadline }}</td>


                            @else


                            <td width="15%" style="text-align: center;" > N/A </td>
                            <td width="15%" style="text-align: center;" > N/A </td>


                            @endif



                             @if($u_task->req_date)

                            <td width="15%" style="text-align: center;">{{ $u_task->req_date }}</td>


                            @else


                            <td width="15%" style="text-align: center;" > N/A </td>
                          


                            @endif



                            @if($u_task->type == 'Task')

                            @if($task->find($u_task->task_id)->priority == 'High')

                                <td width="10%" style="color: red; text-align: center;"> High </td>

                                @elseif($task->find($u_task->task_id)->priority == 'Average' )

                                <td width="10%" style="color: orange; text-align: center;"> Average  </td>

                                @else

                                <td width="10%"  style="color: green; text-align: center;"> Low </td>

                            @endif


                            @elseif($u_task->type == 'G-Task')

                             @if($gtask->find($u_task->gtask_id)->priority == 'High')

                                <td width="10%" style="color: red; text-align: center;"> High </td>

                                @elseif($gtask->find($u_task->gtask_id)->priority == 'Average' )

                                <td width="10%" style="color: orange; text-align: center;"> Average  </td>

                                @else

                                <td width="10%"  style="color: green; text-align: center;"> Low </td>

                            @endif


                            @else


                            <td width="10%" style="text-align: center;" > N/A </td>


                            @endif



                                <td width="20%" style="text-align: center;">

                                    <a href="{{ Asset($link.$u_task->id.'/send-proof') }}" class="btn green tooltipped " data-position="top" data-delay="50" data-tooltip="Attach Completion Proof" style="padding:0px 10px"><i class="fa fa-paperclip"></i></a>

                                     <a href="{{ Asset($link.$u_task->id.'/extend') }}" class="btn cyan tooltipped " data-position="top" data-delay="50" data-tooltip="Request Extension" style="padding:0px 10px"><i class="fa fa-expand"></i></a>


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