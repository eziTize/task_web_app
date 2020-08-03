@extends('admin.layout.main')

@section('title') Search Approve Requests @endsection



@section('content')

<div class="container">

    <div class="section">


        @section('button')

        <a href="{{ Asset($link) }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px"> Back </a>

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

                <br>


        <div id="striped-table">

            <div class="row">

                <div class="col s12 m12 l12">

                    <table class="striped" >

                        <thead>

                            <tr>

                                <th> Name </th>

                                <th style="text-align: center;">Task Name</th>

                                <th style="text-align: center;"> Submit Date </th>

                                <th style="text-align: center;"> Deadline </th>

                                <th style="text-align: center;"> Extended </th>

                                <th style="text-align: center;"> Status </th>

                                <th style="text-align: center;"> Options </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($data as $u_task)

                            
                        @if($u_task->remark)
                            

                            <tr style="color: red;">

                        @else

                            <tr>


                        @endif

 

                           @if($u_task->student_id != null)

                            <td width="10%">{{ $student->find($u_task->student_id)->name }}</td>


                            @else

                            <td width="10%" >{{ $teacher->find($u_task->teacher_id)->name }}</td>


                            @endif



                            <td width="15%" style="text-align: center;">{{$task->find($u_task->task_id)->task_name}}</td>

                            <td style="text-align: center;" width="15%">


                                @if($u_task->completed_at)
                                
                                {{$u_task->completed_at}}

                                @else

                                N/A

                               @endif
                     

                            </td>

                            <td style="text-align: center;" width="10%">

                                @if($u_task->deadline)
                                
                                {{$u_task->deadline}}

                                @else
                                
                                N/A

                                @endif

                            </td>

                            <td style="text-align: center;" width="15%">{{$u_task->req_no}} time(s)</td>



                             @if($u_task->status == 'Approved')

                                <td width="15%" style="text-align: center; color: green"> Approved </td>


                            @elseif($u_task->status == 'Denied')
                                  
                                <td width="15%" style="text-align: center; color: red"> Denied </td>

                            @else

                                <td width="15%" style="text-align: center; color: orange"> Pending </td>

                            @endif



                        <td width="20%" style="text-align: center;">


                                    <a href="{{ Asset($link.$u_task->id.'/download-proof') }}" class="btn blue tooltipped " data-position="top" data-delay="50" data-tooltip="Download Proof" style="padding:0px 10px"><i class="mdi-file-file-download"></i></a>


                             @if($u_task->status != 'Approved')

                                    <a href="{{ Asset($link.$u_task->id.'/approve') }}" class="btn green tooltipped " data-position="top" data-delay="50" data-tooltip="Approve This Request" style="padding:0px 10px"><i class="fa fa-check"></i></a>
                            @endif


                            @if($u_task->status != 'Denied' && $u_task->status != 'Approved')

                                    <form action="{{ Asset($link.$u_task->id.'/deny') }}" method="POST" id="deny_form_{{ $u_task->id }}" class="form-inline">

                                        @csrf

                                        @method('PATCH')

                                        <button type="button" class="btn red tooltipped " data-position="top" data-delay="50" data-tooltip="Deny This Request" style="padding:0px 10px" onclick="confirmAlert('deny',this)"><i class="fa fa-ban"></i></button>

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

