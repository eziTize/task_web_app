@extends('teacher.layout.main')


@section('title') Request For Deadline Extention @endsection


@section('content')

<div class="container">

    <div class="section">

        @section('button')

        <a href="{{ Asset($link) }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px">Back</a>

        @endsection

        <div class="row">


            <div class="col s12 m12 l12">

            {!! Form::model($data, ['method' => 'POST','url' => [env('teacher').'/self-task/'.$data->id.'/extend-submit'],'files' => true,'autocomplete' => 'off'],['class' => 'col s12']) !!}


                <div class="col s12 m12 l12">

                    <div class="card-panel">


                        <div class="row">

                                 <div class="input-field col s12 112">


                                <i class="mdi-social-person prefix"></i>


                                <select style="padding-left: 40px" class="browser-default" name="teacher_id" required disabled="disabled">


                                    <option value="{{$data->teacher_id}}"> {{$teacher->find($data->teacher_id)->name}} </option>


                                </select>

                            </div>

                        </div>

                        <br>

                        <div class="row">

                            <div class="input-field col s12 l6">

                                <i class="fa fa-file-text-o prefix"></i>

                                 @if($data->type == 'Task')

                            
                                    {!! Form::text('name',$task->find($data->task_id)->task_name,['id' => 'task_name','required' => 'required','disabled' => 'disabled']) !!}

                                     <label for="task_name" style="color: black"> Task Name </label>


                                @elseif($data->type == 'G-Task')

                            
                                    {!! Form::text('name',$gtask->find($data->gtask_id)->task_name,['id' => 'task_name','required' => 'required','disabled' => 'disabled']) !!}

                                     <label for="task_name" style="color: black"> Task Name </label>
                            

                                @endif

                            </div>


                            <div class="input-field col s12 l6">

                                <i class="fa fa-calendar prefix"></i>


                                @if($data->type == 'Task')

                            
                                    {!! Form::date('name',$task->find($data->task_id)->end_date,['id' => 'end_date','required' => 'required', 'class' => 'datepicker', 'disabled' => 'disabled']) !!}

                                     <label for="end_date" style="color: black"> Deadline </label>


                                @elseif($data->type == 'G-Task')

                            
                                    {!! Form::date('name',$gtask->find($data->gtask_id)->end_date,['id' => 'end_date', 'class' => 'datepicker', 'required' => 'required','disabled' => 'disabled']) !!}

                                     <label for="end_date" style="color: black"> Deadline </label>
                            

                                @endif


                            </div>


                            <div class="input-field col s12 l12">

                                <i class="fa fa-calendar prefix"></i>

                                {!! Form::date('ex_date', null,['id' => 'ex_date','required' => 'required', 'class' => 'datepicker' ]) !!}

                                <label for="ex_date">Requested Date *</label>


                            </div>


                             <div class="input-field col s12 l12">

                                <i class="fa fa-comment prefix"></i>

                                {!! Form::textarea('ex_reason',null,['id' => 'ex_reason', 'class' => 'materialize-textarea', 'required' => 'required']) !!}

                                <label for="ex_reason">Reason For Request *</label>


                            </div>

                            
                        </div>


                        <div class="row">

                            <div class="input-field col s12">

                                <div class="input-field col s12">

                                    <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit <i class="mdi-content-send right"></i></button>

                                </div>

                            </div>

                        </div>


                    </div>

            </div>


        </div>


    </div>

</div>

@endsection