<?php

namespace App\Http\Controllers\Teacher;

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
    |   GlobalTask List Page
    |------------------------------------------------------------------
    */
    public function index(){


        $teacher_id = Auth::guard('teacher')->user()->id;

        
        $data = [
            'data' => GlobalTask::where('teacher_id', $teacher_id)->where('is_deleted','0')->get(),
            'link' => env('teacher').'/g-task/'
        ];

        return View('teacher.g_task.index',$data);
    }



    /*
    |------------------------------------------------------------------
    |  Self GlobalTask List Page
    |------------------------------------------------------------------
    */
    public function selfIndex(){


        
        $data = [
            'data' => GlobalTask::where('task_for', 'Teachers')->where('is_deleted','0')->get(),
            'admin' => Admin::get(),
            'link' => env('teacher').'/teacher-task/'
        ];

        return View('teacher.g_task.s_index',$data);
    }


    /*
    |------------------------------------------------------------------
    |   GlobalTask Add Page
    |------------------------------------------------------------------
    */
    public function create()
    {

     $data = [
            'data' => new GlobalTask,
            'link' => env('teacher').'/g-task/'
        ];

        return View('teacher.g_task.add',$data);

    }



    /*
    |------------------------------------------------------------------
    |   GlobalTask Data Store
    |------------------------------------------------------------------
    */
    public function store(Request $request)
    {

        $teacher_id = Auth::guard('teacher')->user()->id;

        $data =  new GlobalTask;

        if($data->validate($request->all(),"add")){
            return Redirect(env('teacher').'/g-task/add')->withErrors($data->validate($request->all(),"add"))->withInput();
        }
        $data->teacher_id = $teacher_id;

        $data->priority = $request->input('priority');


        $data->task_for = 'Students';

        $data->task_name = $request->input('task_name');

        $data->task_desc = $request->input('task_desc');
      
        $data->start_date = $request->input('start_date');
       
        $data->end_date = $request->input('end_date');


        $data->save();
       return Redirect(env('teacher').'/g-task')->with('message','New Task Created Successfully.');

    }


    /*
    |------------------------------------------------------------------
    |   GlobalTask Delete (Trash Data)
    |------------------------------------------------------------------
    */
    public function destroy($id)
    {
        //
        $data = GlobalTask::findOrFail($id);
        $data->is_deleted = 1;
        $data->save();

        return back()->with('message','Task Deleted Successfully.');
    }

    /*
    |------------------------------------------------------------------
    |   GlobalTask Trash List Page
    |------------------------------------------------------------------
    */
    public function trash(){
        $data = [
            'data' => GlobalTask::where('is_deleted','1')->get(),           
            'link' => env('teacher').'/g-task/',
            'admin' => Admin::get(),
            'teacher' => Teacher::get(),
        ];

        return View('teacher.g_task.trash',$data);
    }


    /*
    |------------------------------------------------------------------
    |   GlobalTask Data Delete (Permanent)
    |------------------------------------------------------------------
    */
    public function destroyPermanent($id){
        $data = GlobalTask::findOrFail($id);
        $data->delete();

        return back()->with('message','Task Deleted Successfully.');

    }

    /*
    |------------------------------------------------------------------
    |   Edit GlobalTask Page
    |------------------------------------------------------------------
    */
    public function edit($id)
    {


        $data = [
            'id' => $id,
            'data' => GlobalTask::findOrFail($id),
            'link' => env('teacher').'/g-task/'
        ];

        return View('teacher.g_task.edit',$data);
    }


    /*
    |------------------------------------------------------------------
    |   Update GlobalTask
    |------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {


        $teacher_id = Auth::guard('teacher')->user()->id;

        $data =  GlobalTask::findOrFail($id);

         if($data->validate($request->all(),"edit")){
            return Redirect(env('teacher').'/g-task/'.$id.'/edit')->withErrors($data->validate($request->all(),"edit"))->withInput();
        }

        $data->priority = $request->input('priority');


        $data->teacher_id = $teacher_id;

        $data->task_for = 'Students';

        $data->task_name = $request->input('task_name');


        $data->task_desc = $request->input('task_desc');
      

        $data->save();


        //$data->complete_rq = $request->input('complete_rq');


        //$notification = new Notification;

        //$notification->teacher_id = $request->input('asg_teacher_id');

        //$notification->message = 'Your Task has been updated recently';

        //$notification->save();



       return Redirect(env('teacher').'/g-task')->with('message','Task Updated Successfully.');


    }


    /*
    |------------------------------------------------------------------
    |   Extend Time Page
    |------------------------------------------------------------------
    */
    public function extend($id)
    {


        $g_task = GlobalTask::findOrFail($id);

        $data = [
            'id' => $id,
            'data' => $g_task,
            'link' => env('teacher').'/g-task/'
        ];

        return View('teacher.g_task.extend',$data);
    }


    /*
    |------------------------------------------------------------------
    |   Extend Time Submit
    |------------------------------------------------------------------
    */
    public function extendSubmit(Request $request, $id)
    {



        $data =  GlobalTask::findOrFail($id);

         if($data->validate($request->all(),"extend")){
            return Redirect(env('teacher').'/g-task/'.$id.'/extend')->withErrors($data->validate($request->all(),"extend"))->withInput();
        }
       
        $data->extend_rq = $request->input('end_date');

        $data->save();


        //$data->complete_rq = $request->input('complete_rq');


        //$notification = new Notification;

        //$notification->student_id = $request->input('asg_student_id');

        //$notification->message = 'Your Task has been extended recently';

        //$notification->save();



       return Redirect(env('teacher').'/g-task')->with('message','Request Submitted Successfully.');


    }


    /*
    |------------------------------------------------------------------
    |   Proof Submit - Page
    |------------------------------------------------------------------
    */
    public function SendProofPage($id)
    {


    $task = GlobalTask::findOrFail($id);

    $end_date = $task->end_date;


      $teacher_id = Auth::guard('teacher')->user()->id;


    if (UserTask::where('gtask_id', $id )->where('teacher_id', $teacher_id)->count() > 0) {


        $data = [
        
            'link' => env('teacher').'/teacher-task/',

            ];
                return View('teacher.g_task.submitted', $data);
        }

        $data = [
            'id' => $id,
            'data' => $task,
            'today' => Carbon::today(),
            'link' => env('teacher').'/teacher-task/'
        ];

        return View('teacher.g_task.proof_submit',$data);
    }


    /*
    |------------------------------------------------------------------
    |   Proof Submit
    |------------------------------------------------------------------
    */


    public function SendProof(Request $request, $id)


    {
        $g_task =  GlobalTask::findOrFail($id);


        $teacher_id = Auth::guard('teacher')->user()->id;


        $data = new UserTask;
       
        $data->teacher_id = $teacher_id;

        $data->gtask_id = $g_task->id;

        $data->remark = $request->input('remark');

        $data->type = 'G-Task';


        $proof = time().'.'.request()->proof->getClientOriginalExtension();

        $data->proof = $proof;

        $data->save();


            
        request()->proof->move("upload/task_proof/", $proof);





        return Redirect(env('teacher').'/teacher-task')->with('message','Proof Submitted Successfully.');

    }


}
