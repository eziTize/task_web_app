
<div class="row">

	<div class="input-field col s12 l12">

		<i class="mdi-action-home prefix"></i>

		{!! Form::text('name',null,['id' => 'name','required' => 'required']) !!}

		<label for="name">Branch Name *</label>

	</div>


	<div class="input-field col s12 l12">

		<i class="fa fa-map-marker prefix"></i>

		{!! Form::text('address',null,['id' => 'address','required' => 'required']) !!}

		<label for="address">Branch Address *</label>

	</div>

</div>




<div class="row">

	<div class="input-field col s12">

		<div class="input-field col s12">

			<button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit <i class="mdi-content-send right"></i></button>

		</div>

	</div>

</div>
