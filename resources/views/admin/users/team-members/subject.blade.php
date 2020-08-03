@extends('admin.layout.main')

@section('title') Add Subject For {{ $teacher->name }} @endsection



@section('content')

<div class="container">

    <div class="section">

        @section('button')

        <a href="{{ Asset($link) }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px">Back</a>

        @endsection



        <div id="striped-table">

            {!! Form::model($data, ['url' => [env('admin').'/team-members/'.$teacher->id.'/add_subject_store'],'files' => true,'autocomplete' => 'off'],['class' => 'col s12']) !!}

            <div class="row">

                <div class="col s12 m12 l12">

                    <table class="striped" >

                        <thead>

                            <tr>

                                <th>Subject</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($subjects as $subject)

                            <tr>

                                <td width="100%">

                                    <input type="hidden" name="subject_id[{{ $subject->id }}]" value="N">

                                    <input type="checkbox" class="filled-in" id="subject_id_{{ $subject->id }}" name="subject_id[{{ $subject->id }}]" value="Y" {{ Old('subject_id.'.$subject->id) === 'Y' ? 'checked' : '' }}>

                                    <label for="subject_id_{{ $subject->id }}">{{ $subject->name }}</label>

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>



            <div class="row" >

                <div class="input-field col s12">

                    <div class="input-field col s12">

                        <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit <i class="mdi-content-send right"></i></button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection



@section('js')

<script>

    window.onload = function(){

        @foreach($data as $tmsub)

        $('#subject_id_'+{{ $tmsub->subject_id }}).prop('checked',"{{ ($tmsub->status == 'Y') }}");

        @endforeach

    };

</script>

@endsection