@extends('admin.layout.main')
@section('title') Job for {{ $teacher->name }} @endsection

@section('content')
<div class="container">
    <div class="section">
        @section('button')
        <a href="{{ Asset($link) }}" class="btn cyan waves-effect waves-light right" style="margin-top:25px">List</a>
        @endsection

        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card-panel">
                    <div class="row">
                        {!! Form::model($data, ['url' => [env('admin').'/teacher/'.$teacher->id.'/add_job'],'files' => true,'autocomplete' => 'off'],['class' => 'col s12']) !!}
                        <h4 class="header2">Manage Job for {{ $teacher->name }} Here</h4>
                        
                        <div class="row">
                            <div class="input-field col s12 l12">
                                <i class="mdi-action-home prefix"></i>
                                {!! Form::text('job_desc',null,['id' => 'job_desc','required' => 'required']) !!}
                                <label for="job_desc">Job Description *</label>
                            </div>
                        </div>
                            
                        <div class="row">
                            <div class="input-field col s12 l6">
                                <i class="mdi-editor-insert-invitation prefix"></i>
                                {!! Form::date('start_date',null,['id' => 'start_date','class' => 'datepicker','required' => 'required']) !!}
                                <label for="start_date">Start Date *</label>
                            </div>

                            <div class="input-field col s12 l6">
                                <i class="mdi-editor-insert-invitation prefix"></i>
                                {!! Form::date('end_date',null,['id' => 'end_date','class' => 'datepicker','required' => 'required']) !!}
                                <label for="end_date">End Date *</label>
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
                </div>
            </div>

            <?php $comments_user = $job_comment->where('job_id',$data->id)->orderby('id','desc')->get(); ?>
            @if(count($comments_user)>0)
            <div class="col s12 m12 l12">
                <div class="card-panel">
                    <div class="row">
                        <h4 class="header2">Comments</h4>

                        <div class="row">
                            <div class="input-field col s12 l12">
                                @foreach($comments_user as $comment_user)
                                <span>
                                    {{ $comment_user->comment }}
                                    <br>
                                    <small>{{ date('d-M-Y',strtotime($comment_user->created_at)) }}</small>
                                    <br><br>
                                </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection