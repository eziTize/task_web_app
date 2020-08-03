@extends('admin.layout.main')

@section('title') All Team Member Reports @endsection



@section('content')



<div class="container">
<div class="section">

        @section('button')

        <a href="{{ Asset($link) }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px">Back</a>

        @endsection


<div class="row">

    <div class="col s12 m12 l12">


      {!! Form::model($data, ['method' => 'GET','url' => [env('admin').'/team-member-reports-all/search'],'files' => true,'autocomplete' => 'off'],['class' => 'col s12']) !!}
                <div class="input-field col s12 l5">

                        <i class="fa fa-calendar prefix"></i>

                        {!! Form::date('from', null,['id' => 'from','required' => 'required', 'class' => 'datepicker' ]) !!}

                        <label for="from">From </label>


                </div>


                        <div class="input-field col s12 l5">

                            <i class="fa fa-calendar prefix"></i>

                            {!! Form::date('to', null,['id' => 'to','required' => 'required', 'class' => 'datepicker' ]) !!}

                            <label for="to">To </label>


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

                                <th> Member Name </th>

                                <th style="text-align: center;"> Task Name </th>

                                <th style="text-align: center;"> Completed At </th>

                                <th style="text-align: center;"> Status </th>

                                <th style="text-align: center;"> Grade </th>

                            </tr>

                        </thead>

                        <tbody>

                        @foreach($data as $u_task)



                @if($u_task->remark)
                    

                    <tr style="color: red;">

                @else

                    <tr>


                @endif


                        <td width="15%">{{ $teacher->find($u_task->teacher_id)->name }}</td>


                           @if($u_task->type == 'Task')

                            <td width="25%" style="text-align: center;">{{ $task->find($u_task->task_id)->task_name }}</td>


                            @elseif($u_task->type == 'G-Task')

                            <td width="25%" style="text-align: center;" >{{ $gtask->find($u_task->gtask_id)->task_name }}</td>

                            @else


                            <td width="25%" style="text-align: center;" > N/A </td>


                            @endif


                            <td style="text-align: center;" width="20%">{{($u_task->created_at)->format('d-m-y')}}</td>




                             @if($u_task->status == 'Approved')

                                <td width="20%" style="text-align: center; color: green"> Approved </td>


                            @elseif($u_task->status == 'Denied')
                                  
                                <td width="20%" style="text-align: center; color: red"> Denied </td>

                            @else

                                <td width="20%" style="text-align: center; color: orange"> Pending </td>

                            @endif


                            
                            @if($u_task->grade == 'Excellent')

                                <td width="20%" style="text-align: center; color: teal"> Excellent </td>


                            @elseif($u_task->grade == 'Average')
                                  
                                <td width="20%" style="text-align: center; color: orange"> Average </td>


                            @elseif($u_task->grade == 'Normal')


                                <td width="20%" style="text-align: center; color: green"> Normal </td>



                            @else

                                <td width="20%" style="text-align: center"> N/A </td>



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