@extends('admin.layout.main')

@section('title') Assign {{ $teacher->name }} To A Branch @endsection



@section('content')

<div class="container">

    <div class="section">

        @section('button')

        <a href="{{ Asset($link) }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px">Back</a>

        @endsection



        <div id="striped-table">

            {!! Form::model($data, ['url' => [env('admin').'/team-members/'.$teacher->id.'/add_branch_store'],'files' => true,'autocomplete' => 'off'],['class' => 'col s12']) !!}

            <div class="row">

                <div class="col s12 m12 l12">

                    <table class="striped" >

                        <thead>

                            <tr>

                                <th>Branch Name</th>

                                <th> Branch Address </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($branch as $brn)

                            <tr>

                                <td width="35%">

                                    <input type="hidden" name="branch_id[{{ $brn->id }}]" value="N">

                                    <input type="checkbox" class="filled-in" id="branch_id_{{ $brn->id }}" name="branch_id[{{ $brn->id }}]" value="Y" {{ Old('branch_id.'.$brn->id) === 'Y' ? 'checked' : '' }}>

                                    <label for="branch_id_{{ $brn->id }}">{{ $brn->name }}</label>

                                </td>

                                <td width="65%">

                                   {{$brn->address}}

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

        @foreach($data as $tmbrn)

        $('#branch_id_'+{{ $tmbrn->branch_id }}).prop('checked',"{{ ($tmbrn->status == 'Y') }}");

        @endforeach

    };

</script>

@endsection