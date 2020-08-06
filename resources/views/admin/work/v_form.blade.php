<div class="card-panel" style="margin-left: 16px;">

<div class="row" style="padding-left: 20px">



    <div class="input-field col s12 l6">

        <i class="fa fa-file-text-o prefix"></i>

        <input type="text" value="{{$teacher->find($data->teacher_id)->name}}" readonly>


        <label for="user_name">Member Name </label>

    </div>

	   <div class="input-field col s12 l5">

        <i class="fa fa-file-text-o prefix"></i>


        <input type="text" value="{{ $data->name }}" readonly>

        <label for="name">Work Name </label>

    </div>


    <div class="input-field col s12 l11">

        <i class="fa fa-edit prefix"></i>


        <input type="text" value="{{ $data->desc }}" readonly>

        <label for="desc">Description </label>

    </div>


    <div class="input-field col s12 l3">

        <i class="fa fa-calendar prefix"></i>

        <input type="date" value="{{ $data->start_date }}" readonly>


    </div>


    <div class="input-field col s12 l4">

    <i class="fa fa-clock-o prefix"></i>

    <input type="time" value="{{ $data->started_at }}" readonly>


    </div>


    <div class="input-field col s12 l4">

    <i class="fa fa-clock-o prefix"></i>

        <input type="time" value="{{ $data->ended_at }}" readonly>


    </div>

  </div>

</div>




