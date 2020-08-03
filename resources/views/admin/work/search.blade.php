@extends('admin.layout.main')

@section('title') Search Work Log @endsection



@section('content')

<div class="container">

    <div class="section">


        <div class="row" style=" padding-bottom: 25px">

        <div class="col s12 m12 l12">


           <form action="{{ Asset($link) }}" method="GET" id="search_form" class="col s12">



                    <div class="input-field col s12 l4">

                     <i class="fa fa-user prefix"></i>

                        <select style="padding-left: 40px" class="browser-default" name="user_id" required>

                            <option value="">Select Team Member *</option>


                                @foreach($teacher as $teachers)

                                        <option value="{{ $teachers->id }}">

                                        {{ $teachers->name }}, ID: {{ $teachers->id }}

                                        </option>

                                @endforeach


                            </select>

                        </div>

   


                        <div class="input-field col s12 l3">

                                <i class="fa fa-calendar prefix"></i>

                                {!! Form::date('from', null,['id' => 'from','required' => 'required', 'class' => 'datepicker' ]) !!}

                                <label for="from">From </label>


                        </div>

                                <div class="input-field col s12 l3">

                                    <i class="fa fa-calendar prefix"></i>

                                    {!! Form::date('to', null,['id' => 'to','required' => 'required', 'class' => 'datepicker' ]) !!}

                                    <label for="to">To </label>


                                </div>

            

                            <div class="input-field col s2 l2">

                        <button class="btn green waves-effect waves-light" type="submit" name="action">Search <i class="fa fa-search left"></i></button>

                            </div>
            </form>

        </div>
        </div>

    @if($from && $to && $user_id)

    @if($from == $to)

            <h6 style=" padding-bottom: 25px; font-size: 17px"><i class="fa fa-calendar-check-o prefix"></i> <b>{{$teacher->find($user_id)->name}}</b>'s Work Log of {{$from}}: </h6>

    @else
            <h6 style=" padding-bottom: 25px; font-size: 17px"><i class="fa fa-calendar-check-o prefix"></i> <b>{{$teacher->find($user_id)->name}}</b>'s Work Log from {{$from}} to {{ $to }}: </h6>
    @endif

    @endif
    
        @foreach($data as $work)

        <div class="card-panel" style="margin-bottom: 17px; margin-left: 20px;">

            <div class="row">


                <div class="input-field col s12 l6">

                    <i class="fa fa-file-text-o prefix"></i>

                    <input type="text" value="{{$teacher->find($work->teacher_id)->name}}" readonly>


                    <label for="user_name">Member Name </label>

                </div>

                <div class="input-field col s12 l5">

                    <i class="fa fa-file-text-o prefix"></i>


                    <input type="text" value="{{ $work->name }}" readonly>

                    <label for="name">Work Name</label>

                </div>


                <div class="input-field col s12 l11">

                    <i class="fa fa-info prefix"></i>


                    <input type="text" value="{{ $work->desc }}" readonly>

                    <label for="desc">Description</label>

                </div>


                <div class="input-field col s12 l3">

                    
                    <i class="fa fa-calendar prefix"></i>


                    <input type="date" value="{{ $work->start_date }}" readonly>

                </div>



                <div class="input-field col s12 l4">


                    <i class="fa fa-clock-o prefix"></i>


                    <input type="time" value="{{ $work->started_at }}" readonly>


                </div>


                <div class="input-field col s12 l4">

                    <i class="fa fa-clock-o prefix"></i>


                    <input type="time" value="{{ $work->ended_at }}" readonly>


                </div>



                <div class="input-field col s1">

                    <a class="btn green tooltipped" href="{{ Asset($link.$work->id.'/edit') }}" style="padding:0px 10px" data-position="top" data-delay="50" data-tooltip="Edit This Entry"><i class="fa fa-edit fa-2x"></i></a>

                     <form action="{{ Asset($link.$work->id.'/destroy_permanent') }}" method="POST" id="destroyPermanent_form_{{ $work->id }}" class="form-inline">

                                        @csrf

                                        @method('DELETE')

                                        <button type="button" class="btn red tooltipped " data-position="top" data-delay="50" data-tooltip="Delete This Entry" style="padding:0px 10px" onclick="confirmAlert('delete',this)"><i class="fa fa-trash"></i></button>

                    </form>

                </div>


            </div>

        </div>        

        @endforeach


    </div>

</div>


@endsection