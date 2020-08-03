@extends('teacher.layout.main')


@section('title') Submit proof (Only: jpg/jpeg/png/pdf/doc/docx) @endsection


@section('content')

<div class="container">

    <div class="section">

        @section('button')

        <a href="{{ Asset($link) }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px">Back</a>

        @endsection

        <div class="row">


              <div class="col s12 m12 l12">

            {!! Form::model($data, ['method' => 'POST','url' => [env('teacher').'/teacher-task/'.$data->id.'/send-proof-submit'],'files' => true,'autocomplete' => 'off'],['class' => 'col s12']) !!}


                <div class="col s12 m12 l12">

                    <div class="card-panel">

                        <div class="row">



                            <div class="input-field col s12 l6">

                                <i class="fa fa-file-text-o prefix"></i>

                                 {!! Form::text('name',$data->task_name,['id' => 'task_name','required' => 'required','disabled' => 'disabled']) !!}

                                     <label for="task_name" style="color: black"> Task Name </label>

                            </div>


                            <div class="input-field col s12 l6">

                                <i class="fa fa-calendar prefix"></i>

                         {!! Form::text('name',$data->end_date,['id' => 'end_date','required' => 'required','disabled' => 'disabled']) !!}

                                     <label for="end_date" style="color: black"> End Date </label>

                            </div>



                            @if($data->end_date < $today)

                            <div class="input-field col s12">

                                <i class="fa fa-exclamation prefix" style="color: red;"></i>

                                 {!! Form::text('remark',null,['id' => 'remark','required' => 'required']) !!}

                                     <label for="remark" style="color: red"> Late Completion Reason </label>

                            </div>

                            @endif
                 

                    </div>


                <div class="col s12 m12 l12">


                        <div class="row">

                        @include('teacher.g_task.upload_field')

                        <span id="upload_field"></span>

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

@endsection