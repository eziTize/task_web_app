@extends('admin.layout.main')


@section('title') Extend Task Time @endsection


@section('content')

<div class="container">

    <div class="section">

        @section('button')
        <a href="{{ Asset($link) }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px">Back</a>
        @endsection

        <div class="row">


            <div class="col s12 m12 l12">

            {!! Form::model($data, ['method' => 'POST','url' => [env('admin').'/g-task/'.$data->id.'/extend-submit'],'files' => true,'autocomplete' => 'off'],['class' => 'col s12']) !!}



                        <div class="row">

                            <div class="input-field col s12 l6">

                                <i class="fa fa-file-text-o prefix"></i>

                                {!! Form::text('task_name', $data->task_name,['id' => 'task_name','required' => 'required',  'disabled'=> 'disabled']) !!}

                                <label for="task_name"> Task Name *</label>

                            </div>


                            <div class="input-field col s12 l6">

                                <i class="fa fa-flag prefix"></i>

                                {!! Form::text('task_desc', $data->task_desc,['id' => 'task_desc', 'required' => 'required', 'disabled'=> 'disabled' ]) !!}

                                <label for="task_desc">Task Description *</label>

                            </div>

                            <div class="input-field col s12 l6">

                                <i class="fa fa-calendar prefix"></i>

                                {!! Form::date('start_date', $data->start_date,['id' => 'start_date','required' => 'required', 'class' => 'datepicker', 'disabled'=> 'disabled' ]) !!}

                                <label for="start_date">Start Date *</label>


                            </div>


                            <div class="input-field col s12 l6">

                                <i class="fa fa-calendar prefix"></i>

                                {!! Form::date('end_date', $data->end_date,['id' => 'end_date','required' => 'required', 'class' => 'datepicker' ]) !!}

                                <label for="end_date">End Date *</label>


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