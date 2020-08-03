@extends('teacher.layout.main')

@section('title') Search Your Reports @endsection



@section('content')

<div class="container">

<div class="section">

        @section('button')

        <a href="{{ Asset($link) }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px">Back</a>

        @endsection


<div class="row">

<div class="col s12 m12 l12">


 {!! Form::model($data, ['method' => 'GET','url' => [env('teacher').'/reports-search'],'files' => true,'autocomplete' => 'off'],['class' => 'col s12']) !!}
                <div class="input-field col s12 l5">

                        <i class="fa fa-calendar prefix"></i>

                        {!! Form::date('from', null,['id' => 'from','required' => 'required', 'class' => 'datepicker' ]) !!}

                        <label for="from">From Deadline</label>


                </div>


                        <div class="input-field col s12 l5">

                            <i class="fa fa-calendar prefix"></i>

                            {!! Form::date('to', null,['id' => 'to','required' => 'required', 'class' => 'datepicker' ]) !!}

                            <label for="to">To Deadline</label>


                        </div>

    

                    <div class="input-field col s2 l2">

                <button class="btn green waves-effect waves-light" type="submit" name="action">Search <i class="fa fa-search left"></i></button>

                    </div>


</div>
</div>
</div>
   


    <div class="section">


        <div id="striped-table">

            <div class="row">

                <div class="col s12 m12 l12">

                     <table class="striped" >

                        <thead>

                            <tr>

                                <th> Task Name </th>

                                <th style="text-align: center;"> Submit Date </th>

                                <th style="text-align: center;"> Deadline </th>

                                <th style="text-align: center;"> Extended </th>

                                <th style="text-align: center;"> Status </th>

                                <th style="text-align: center;"> Grade </th>

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

                            <td width="20%" style="padding-left: 17px">{{ $task->find($u_task->task_id)->task_name }}</td>


                            @elseif($u_task->type == 'G-Task')

                            <td width="20%" style="padding-left: 17px">{{ $gtask->find($u_task->gtask_id)->task_name }}</td>

                            @else


                            <td width="20%" style="padding-left: 17px"> N/A </td>


                            @endif


                            <td style="text-align: center;" width="20%">


                                @if($u_task->completed_at)
                                
                                {{$u_task->completed_at}}

                                @else

                                N/A

                               @endif
                     

                            </td>

                            <td style="text-align: center;" width="15%">

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


                            
                            @if($u_task->grade == 'Excellent')

                                <td width="15%" style="text-align: center; color: teal"> Excellent </td>


                            @elseif($u_task->grade == 'Average')
                                  
                                <td width="15%" style="text-align: center; color: orange"> Average </td>


                            @elseif($u_task->grade == 'Normal')


                                <td width="15%" style="text-align: center; color: green"> Normal </td>



                            @else

                                <td width="15%" style="text-align: center"> N/A </td>



                            @endif


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