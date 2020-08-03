<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Student;
use App\Teacher;
use App\UserTask;
use App\GlobalTask;
use App\Task;
use App\Admin;
use Carbon\Carbon;
use Redirect;


class GlobalTaskController extends Controller
{


    /*
    |------------------------------------------------------------------
    |  Self GlobalTask List Page
    |------------------------------------------------------------------
    */
    public function index(){
        
        $data = [
            'data' => GlobalTask::where('task_for', 'Students')->where('is_deleted','0')->get(),
            'admin' => Admin::get(),
            'student' => Auth::guard('student'),
            'teacher' => Teacher::get(),
            'link' => env('student').'/student-task/'
        ];

        return View('student.g_task.s_index',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Proof Submit - Page
    |------------------------------------------------------------------
    */
    public function SendProofPage($id)
    {


        $g_task = GlobalTask::findOrFail($id);
        $student_id = Auth::guard('student')->user()->id;


    if (UserTask::where('gtask_id', $id )->where('student_id', $student_id)->count() > 0) {


        $data = [
        
            'link' => env('student').'/student-task/',

            ];
                return View('student.g_task.submitted', $data);
        }

                 $data = [
                    'id' => $id,
                    'data' => $g_task,
                    'today' => Carbon::today(),
                    'link' => env('student').'/student-task/'
                ];

                return View('student.g_task.proof_submit',$data);
    }


    /*
    |------------------------------------------------------------------
    |   Proof Submit
    |------------------------------------------------------------------
    */


    public function SendProof(Request $request, $id)


    {
        $g_task =  GlobalTask::findOrFail($id);

        $student_id = Auth::guard('student')->user()->id;


        $data = new UserTask;
       
        $data->student_id = $student_id;

        $data->gtask_id = $g_task->id;

        $data->remark = $request->input('remark');

        $data->type = 'G-Task';


        $proof = time().'.'.request()->proof->getClientOriginalExtension();

        
        $data->proof = $proof;

            
        request()->proof->move("upload/task_proof/", $proof);



        $data->save();


        return Redirect(env('student').'/student-task')->with('message','Proof Submitted Successfully.');

    }


}
