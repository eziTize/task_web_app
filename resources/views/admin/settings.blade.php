@extends('admin.layout.main')
@section('title') Account Settings @endsection

@section('content')
<div class="container">
    <div class="section">
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card-panel">
                    <div class="row">
                        <form class="col s12" action="{{ Asset(env('admin').'/settings') }}" method="post" autocomplete="off">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <h4 class="header2">Update Your Account Setting Here</h4>

                            <div class="row">
                                <div class="input-field col s12 l6">
                                    <i class="mdi-action-account-circle prefix"></i>
                                    <input id="name" type="text" name="name" required value="{{ $data->name }}">
                                    <label for="name">Name *</label>
                                </div>
                                <div class="input-field col s12 l6">
                                    <i class="mdi-communication-email prefix"></i>
                                    <input id="email" class="tolowercase" type="email" required name="email" value="{{ $data->email }}">
                                    <label for="email">Email *</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12 l6">
                                    <i class="mdi-action-lock-outline prefix"></i>
                                    <input id="password" type="password" placeholder="We need your current password for update settings" required name="password">
                                    <label for="password">Current Password</label>
                                </div>

                                <div class="input-field col s12 l6">
                                    <i class="mdi-action-lock-outline prefix"></i>
                                    <input id="new_password" type="password" placeholder="Enter new password if you want to change current password" name="new_password">
                                    <label for="new_password">New Password</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="fa fa-phone prefix"></i>
                                    <input id="phone" type="number" placeholder="Phone number must be of digits" name="phone" value="{{ $data->phone }}">
                                    <label for="phone">Phone</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <div class="input-field col s12">
                                        <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Update <i class="mdi-content-send right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection