<div class="row" style="padding-bottom: 25px">
	<div class="input-field col s12 l6">
		<i class="mdi-action-home prefix"></i>
		{!! Form::text('name',null,['id' => 'name','required' => 'required']) !!}
		<label for="name">Team Member Name *</label>
	</div>
	<div class="input-field col s12 l6">
		<i class="mdi-communication-email prefix"></i>
		{!! Form::email('email',null,['id' => 'email','class' => 'tolowercase','required' => 'required']) !!}
		<label for="email">Email *</label>
	</div>

	<div class="input-field col s12">

				{!! Form::select('gender',['Male' => 'Male', 'Female' => 'Female'],$data->gender,['class' => 'browser-default']) !!}
	</div>

</div>


	@isset($id)<small style="color:red">(Enter new password here if you want to change current password.)</small>@endif


<div class="row">
	<div class="input-field col s12 l6">
		<i class="mdi-action-lock prefix"></i>
		{!! Form::password('password',null,['id' => 'password','required' => 'required']) !!}
		<label for="password">Password *</label>
	</div>


	<div class="input-field col s12 l6">
		<i class="mdi-action-lock prefix"></i>
		{!! Form::password('confirm_password',null,['id' => 'confirm_password','required' => 'required']) !!}
		<label for="confirm_password">Confirm Password *</label>
	</div>
</div>

<div class="row">
	<div class="input-field col s12 l12">
		<i class="mdi-communication-phone prefix"></i>
		{!! Form::number('phone',null,['id' => 'phone','placeholder' => 'Phone number must be of digits']) !!}
		<label for="phone">Phone</label>
	</div>
</div>

<div class="row">
	<div class="input-field col s12 l12">
		<i class="mdi-action-home prefix"></i>
		{!! Form::text('address',null,['id' => 'address']) !!}
		<label for="address">Address</label>
	</div>
</div>


<div class="row"  style="padding-top: 45px">
	<div class="input-field col s12 l12">
		{!! Form::select('status',['0' => 'Enable', '1' => 'Disable'],$data->status) !!}
	</div>
</div>

<div class="row">
	<div class="input-field col s12">
		<div class="input-field col s12">
			<button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit <i class="mdi-content-send right"></i></button>
		</div>
	</div>
</div>