
@php($uid = rand(11,999))

@php ($branch = App\Branch::where('is_deleted','0')->get())

@php ($subject = App\Subject::where('is_deleted','0')->get())



<div class="row" id="select_field_{{ $uid }}">    

    <div class="input-field col s12 l6">


		<i class="fa fa-building prefix"></i>


		<select name="branch_id[]" class="browser-default" id="branch_id_{{ $uid }}" style="padding-left: 40px" required>



					<option value="All">

							All Branches

					</option>

    				@foreach($branch as $brn)

                        <option value="{{ $brn->id }}">

                           {{ $brn->name }}

                        </option>

                    @endforeach




		</select>

	</div>

	<div class="input-field col s12 l5">


		<i class="fa fa-book prefix"></i>


		<select name="subject_id[]" class="browser-default" id="subject_id_{{ $uid }}" style="padding-left: 40px" required>



				   <option value="All">

						   All Subjects

					</option>

    				@foreach($subject as $sub)

                        <option value="{{ $sub->id }}">

                           {{ $sub->name }}

                        </option>

                    @endforeach


		</select>

	</div>



    <div class="input-field col s1">

          <a href="javascript:void(0);" class="btn red" onclick="Remove(select_field_{{ $uid }})" class="btn red" style="padding:0px 10px"><i class="fa fa-trash fa-2x"></i></a>

    </div>

</div>

