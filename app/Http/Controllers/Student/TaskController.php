<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Task;
use App\Admin;
use App\Student;
use App\Teacher;
use App\UserTask;
use Redirect;
use Carbon\Carbon;

class TaskController extends Controller
{

    /*
    |------------------------------------------------------------------
    |   Task List Page - Self
    |------------------------------------------------------------------
    */
    public function index(){


        $student_id = Auth::guard('student')->user()->id;

        
        $data = [
            'data' => Task::where('asg_student_id', $student_id)->where('is_deleted','0')->get(),
            'student' => Auth::guard('student'),
            'admin' => Admin::get(),
            'teacher' => Teacher::get(),
            'link' => env('student').'/self-task/'
        ];

        return View('student.task.index',$data);
    }


    /*
    |------------------------------------------------------------------
    |   Proof Submit - Page
    |------------------------------------------------------------------
    */
    public function SendProofPage($id)
    {


        $task = Task::findOrFail($id);

        $student_id = Auth::guard('student')->user()->id;


    if (UserTask::where('task_id', $id )->where('student_id', $student_id)->count() > 0) {


        $data = [
        
            'link' => env('student').'/self-task/',

            ];
                return View('student.task.submitted', $data);
        }

        $data = [
            'id' => $id,
            'data' => $task,
            'today' => Carbon::today(),
            'link' => env('student').'/self-task/'
        ];

        return View('student.task.proof_submit',$data);
    }


    /*
    |------------------------------------------------------------------
    |   Proof Submit
    |------------------------------------------------------------------
    */


    public function SendProof(Request $request, $id)


    {
        $task =  Task::findOrFail($id);

        $student_id = Auth::guard('student')->user()->id;


        $data = new UserTask;
       
        $data->student_id = $student_id;

        $data->task_id = $task->id;

        $data->remark = $request->input('remark');

        $data->type = 'Task';


        $proof = time().'.'.request()->proof->getClientOriginalExtension();

        
        $data->proof = $proof;

            
        request()->proof->move("upload/task_proof/", $proof);



        $data->save();


        return Redirect(env('student').'/self-task')->with('message','Proof Submitted Successfully.');

    }


}
