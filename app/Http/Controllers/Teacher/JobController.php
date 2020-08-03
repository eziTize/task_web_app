<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Job;
use App\JobComment;

class JobController extends Controller
{
    /*
    |------------------------------------------------------------------
    |   Job List Page
    |------------------------------------------------------------------
    */
    public function index(){
        $teacher_id = Auth::guard('teacher')->user()->id;
        
        $data = [
            'data' => Job::where('teacher_id', $teacher_id)->get(),
            'job_comment' => new JobComment,
            'link' => env('teacher').'/job/'
        ];

        return View('teacher.job.index',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Add Comment for Job
    |------------------------------------------------------------------
    */
    public function addComment(Request $request,$id){
        $data = new JobComment;

        if($data->validate($request->all())){
            return Redirect(env('teacher').'/job')->withErrors($data->validate($request->all()))->withInput();
        }
        
        $data->job_id = $id;
        $data->comment = $request->get('comment');
        $data->save();

        return Redirect(env('teacher').'/job')->with('message','Comment Made Successfully.');
    }

    /*
    |------------------------------------------------------------------
    |   Finish Job Request
    |------------------------------------------------------------------
    */
    public function finishJob(Request $request,$id){
        $data = Job::where('id',$id)->where('status','0')->update(['finish_request' => '1']);

        return Redirect(env('teacher').'/job')->with('message','Job Finished Successfully.');
    }
}
