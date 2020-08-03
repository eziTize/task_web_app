<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Student;
use App\Teacher;
use App\UserTask;
use App\GlobalTask;
use App\Admin;
use Response;

use Redirect;

class GlobalTaskController extends Controller
{
    /*
    |------------------------------------------------------------------
    |   GlobalTask List Page
    |------------------------------------------------------------------
    */
    public function index(){


        $admin_id = Auth::guard('admin')->user()->id;

        
        $data = [
            'data' => GlobalTask::where('admin_id', $admin_id)->where('is_deleted','0')->get(),
            'link' => env('admin').'/g-task/'
        ];

        return View('admin.g_task.index',$data);
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
            'link' => env('admin').'/g-task/'
        ];

        return View('admin.g_task.add',$data);

    }



    /*
    |------------------------------------------------------------------
    |   GlobalTask Data Store
    |------------------------------------------------------------------
    */
    public function store(Request $request)
    {

        $admin_id = Auth::guard('admin')->user()->id;

        $data =  new GlobalTask;

        if($data->validate($request->all(),"add")){
            return Redirect(env('admin').'/g-task/add')->withErrors($data->validate($request->all(),"add"))->withInput();
        }
        $data->admin_id = $admin_id;

        $data->priority = $request->input('priority');


        $data->task_for = $request->input('task_for');

        $data->task_name = $request->input('task_name');

        $data->task_desc = $request->input('task_desc');
      
        $data->start_date = $request->input('start_date');
       
        $data->end_date = $request->input('end_date');


        $data->save();
       return Redirect(env('admin').'/g-task')->with('message','New Task Created Successfully.');

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
            'link' => env('admin').'/g-task/',
            'admin' => Admin::get(),
            'teacher' => Teacher::get(),
        ];

        return View('admin.g_task.trash',$data);
    }


    /*
    |------------------------------------------------------------------
    |   GlobalTask Data Restore
    |------------------------------------------------------------------
    */
    public function restore($id){
        $data = GlobalTask::findOrFail($id);
        $data->is_deleted = false;
        $data->save();

        return back()->with('success_message','Task Restored Successfully.');

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
            'link' => env('admin').'/g-task/'
        ];

        return View('admin.g_task.edit',$data);
    }


    /*
    |------------------------------------------------------------------
    |   Update GlobalTask
    |------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {


        $admin_id = Auth::guard('admin')->user()->id;

        $data =  GlobalTask::findOrFail($id);

        if($data->validate($request->all(),"edit")){
            return Redirect(env('admin').'/g-task/'.$id.'/edit')->withErrors($data->validate($request->all(),"edit"))->withInput();
        }

        $data->admin_id = $admin_id;

        $data->task_for = $request->input('task_for');

        $data->task_name = $request->input('task_name');

        $data->priority = $request->input('priority');


        $data->task_desc = $request->input('task_desc');
      
    

        $data->save();


        //$data->complete_rq = $request->input('complete_rq');


        //$notification = new Notification;

        //$notification->teacher_id = $request->input('asg_teacher_id');

        //$notification->message = 'Your Task has been updated recently';

        //$notification->save();



       return Redirect(env('admin').'/g-task')->with('message','Task Updated Successfully.');


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
            'link' => env('admin').'/g-task/'
        ];

        return View('admin.g_task.extend',$data);
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
            return Redirect(env('admin').'/g-task/'.$id.'/extend')->withErrors($data->validate($request->all(),"extend"))->withInput();
        }
       
        $data->end_date = $request->input('end_date');

        $data->save();


        //$data->complete_rq = $request->input('complete_rq');


        //$notification = new Notification;

        //$notification->student_id = $request->input('asg_student_id');

        //$notification->message = 'Your Task has been extended recently';

        //$notification->save();



       return Redirect(env('admin').'/g-task')->with('message','End Date Updated Successfully.');


    }



    /*
    |------------------------------------------------------------------
    |   Approve GlobalTask List
    |------------------------------------------------------------------
    */

    public function ApproveTaskIndex()
    {

        $admin_id = Auth::guard('admin')->user()->id;


        $u_task =  UserTask::where('type','G-Task')->where('status','Pending')->get();
        $g_task =  GlobalTask::get();

        
        $data = [
            'data' => $u_task,
            'g_task' => $g_task,
            'teacher' => Teacher::get(),
            'student' => Student::get(),
            'link' => env('admin').'/g-task-requests/'
        ];

        return View('admin.g_task.a_index',$data);

    }


    /*
    |------------------------------------------------------------------
    |   Index - Search
    |------------------------------------------------------------------
    */

    public function ApproveSearch(Request $request){

    
    $admin_id = Auth::guard('admin')->user()->id;
    $u_task = UserTask::where('type','G-Task')->whereBetween('created_at', [$request->get('from'), $request->get('to')])->where('status','Pending')->get();
    $g_task =  GlobalTask::get();

        $data = [
           'data' => $u_task,
            'g_task' => $g_task,
            'teacher' => Teacher::get(),
            'student' => Student::get(),
            'link' => env('admin').'/g-task-requests/'
        ];


        return View('admin.g_task.search',$data);


    }



    /*
    |------------------------------------------------------------------
    |   Approve GlobalTasks
    |------------------------------------------------------------------
    */

    public function ApproveTasks(Request $request, $id)
    {



        $data =  UserTask::findOrFail($id);

       
        $data->status = 'Approved';
        $data->grade = $request->input('grade');


        $data->save();


       return Redirect(env('admin').'/g-task-requests')->with('message','Task Approved Successfully.');


    }


    /*
    |------------------------------------------------------------------
    |   Approve GlobalTasks Page
    |------------------------------------------------------------------
    */

    public function ApproveTasksPage($id)
    {



        $u_task = UserTask::findOrFail($id);
        $g_task =  GlobalTask::get();

        $data = [
            'data' => $u_task,
            'teacher' => Teacher::get(),
            'student' => Student::get(),
            'g_task' => $g_task,
            'link' => env('admin').'/g-task-requests/'
        ];

        return View('admin.g_task.approve',$data);


    }


    /*
    |------------------------------------------------------------------
    |   Deny Approve Request
    |------------------------------------------------------------------
    */

    public function DenyTask(Request $request, $id)
    {



        $data =  UserTask::findOrFail($id);

       
        $data->status = 'Denied';

        $data->save();


       return Redirect(env('admin').'/g-task-requests')->with('message','Task Denied Successfully.');


    }


    /*
    |------------------------------------------------------------------
    |   Download Proof
    |------------------------------------------------------------------
    */
    public function downloadProof($id)
    {

            $u_task = UserTask::findOrFail($id);

            $file_path = 'upload/task_proof/'. $u_task->proof;

            if($u_task->proof == null) {

                return back()->with('error','No File Found.');


            }
            return Response::download($file_path);

    }


     /*
    |------------------------------------------------------------------
    |   Extend Requests - Page
    |------------------------------------------------------------------
    */
    public function ExtendRequests(){

        
        $data = [

            'data' => UserTask::where('has_request', 1)->where('type', 'G-Task')->get(),
            'teacher' => Teacher::get(),
            //'student'=> Student::get(),
            'link' => env('admin').'/g-extend-requests/'
        ];

        return View('admin.g_task.er_index',$data);
    }



    /*
    |------------------------------------------------------------------
    |   Approve Extend Request
    |------------------------------------------------------------------
    */
    public function ExtendR($id){

        
        $data = UserTask::findOrFail($id);
        $data->req_no = $data->req_no + 1;

        $data->save();

       return Redirect(env('admin').'/g-extend-requests')->with('message','Request Approved Successfully.');

    }


    /*
    |------------------------------------------------------------------
    |   Remove Extend Request
    |------------------------------------------------------------------
    */
    public function erRemove($id){

        
        $data = UserTask::findOrFail($id);
        $data->has_request = 0;

        $data->save();

       return Redirect(env('admin').'/g-extend-requests')->with('message','Request Removed Successfully.');

    }


}
