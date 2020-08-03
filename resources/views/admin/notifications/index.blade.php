@extends('admin.layout.main')

@section('title') Your Notifications @endsection



@section('content')

<div class="container">

    <div class="section">


        <div id="striped-table">

            <div class="row">

                <div class="col s12 m12 l12">

                    <table class="striped" >

                        <thead>

                            <tr>

                                <th>Notification</th>

                                <th style="text-align: center;" >Date</th>
                                
                                <th style="text-align: center;">Option</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($data as $notifications)

                            <tr>

                                <td width="60%"> {{ $notifications->message }} </td>

                                <td style="text-align: center;" width="20%"> {{ ($notifications->created_at)->format('d-m-y') }} </td>

                                <td style="text-align: center;" width="20%">  

                                    <form action="{{ Asset($link.'destroy/'.$notifications->id) }}" method="POST" id="delete_form_{{ $notifications->id }}" class="form-inline">

                                        @csrf

                                        @method('DELETE')

                                        <button type="button" class="btn red tooltipped " data-position="top" data-delay="50" data-tooltip="Delete Notification" style="padding:0px 10px" onclick="confirmAlert('destroy_permanent',this)"><i class="mdi-content-clear"></i></button>

                                    </form>
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