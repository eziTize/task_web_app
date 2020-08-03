<div class="card-panel" style="margin-left: 16px;">

<div class="row" style="padding-left: 20px">

	   <div class="input-field col s12 l11">

        <i class="fa fa-file-text-o prefix"></i>


        {!! Form::text('name',null,['id' => 'name', 'required' => 'required']) !!}

        <label for="name">Work Name *</label>

    </div>


    <div class="input-field col s12 l11">

        <i class="fa fa-edit prefix"></i>


        {!! Form::textarea('desc',null,['id' => 'desc', 'class' => 'materialize-textarea', 'required' => 'required']) !!}

        <label for="desc">Description *</label>

    </div>


    <div class="input-field col s12 l3">

        <i class="fa fa-calendar prefix"></i>

        {!! Form::date('start_date',null,['id' => 'start_date', 'required' => 'required', 'disabled' => 'disabled']) !!}


    </div>


    <div class="input-field col s12 l4">

    <i class="fa fa-clock-o prefix"></i>

        {!! Form::time('started_at',null,['id' => 'started_at', 'required' => 'required']) !!}


    </div>


    <div class="input-field col s12 l4">

    <i class="fa fa-clock-o prefix"></i>

        {!! Form::time('ended_at',null,['id' => 'ended_at', 'required' => 'required']) !!}


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



