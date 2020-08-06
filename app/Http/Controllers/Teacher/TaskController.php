<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Task;
use App\Admin;
use App\Student;
use App\Teacher;
use App\UserTask;
use App\GlobalTask;
use Carbon\Carbon;
use Redirect;

class TaskController extends Controller
{
    /*
    |------------------------------------------------------------------
    |   Task List Page - Student
    |------------------------------------------------------------------
    */
    public function studentIndex(){


        $teacher_id = Auth::guard('teacher')->user()->id;

        $data = [
            'data' => Task::where('teacher_id', $teacher_id)->where('asg_teacher_id', null)->where('is_deleted','0')->whereDate('start_date', '>=' ,Carbon::today()->subDays(14)->toDateString())->get(),
            'student' => Student::where('is_deleted','0')->get(),
            'link' => env('teacher').'/student-task/'
        ];

        return View('teacher.task.student.index',$data);
    }


    /*
    |------------------------------------------------------------------
    |   Task List Page - Student - Search
    |------------------------------------------------------------------
    */

    public function studentIndexSearch(Request $request){

    
    $teacher_id = Auth::guard('teacher')->user()->id;

        $data = [

            'data' => Task::where('teacher_id', $teacher_id)->where('asg_teacher_id', null)->where('is_deleted','0')->whereBetween('end_date', [$request->get('from'), $request->get('to')])->get(),

            'student' => Student::where('is_deleted','0')->get(),
            'link' => env('teacher').'/student-task/'
        ];


        return View('teacher.task.student.search',$data);


    }


    /*
    |------------------------------------------------------------------
    |   Task List Page - Self
    |------------------------------------------------------------------
    */
    public function TeacherIndex(){


        $data = [
            'data' => UserTask::where(function($query){
                $query->where('teacher_id', Auth::guard('teacher')->user()->id)->where('status', 'Approved')->whereDate('deadline', '>=' ,Carbon::now()->subDays(10));
            })->orWhere(function($query){
                $query->where('teacher_id', Auth::guard('teacher')->user()->id)->where('status', '!=', 'Approved');
            })->get(),

            'task' => Task::get(),
            'gtask' => GlobalTask::get(),
            'teacher' => Teacher::get(),
            'admin' => Admin::get(),
            'link' => env('teacher').'/self-task/'
        ];

        return View('teacher.task.self.index',$data);
    }


    /*
    |------------------------------------------------------------------
    |   Task List Page - Self - Search
    |------------------------------------------------------------------
    */

    public function TeacherIndexSearch(Request $request){

    
    $teacher_id = Auth::guard('teacher')->user()->id;

        $data = [

            'data' => UserTask::where('teacher_id', $teacher_id)->whereBetween('deadline', [$request->get('from'), $request->get('to')])->get(),
            'task' => Task::get(),
            'gtask' => GlobalTask::get(),
            'teacher' => Auth::guard('teacher'),
            'admin' => Admin::get(),
            'link' => env('teacher').'/self-task/'
        ];


        return View('teacher.task.self.search',$data);


    }


    /*
    |------------------------------------------------------------------
    |   Task Add Page - Student
    |------------------------------------------------------------------
    */
    public function createStudentTask()
    {

     $data = [
            'data' => new Task,
            'student' => Student::get(),
            'link' => env('teacher').'/student-task/'
        ];

        return View('teacher.task.student.add',$data);

    }


    /*
    |------------------------------------------------------------------
    |   Task Data Store - Student
    |------------------------------------------------------------------
    */
    public function storeStudentTask(Request $request)
    {

        $teacher_id = Auth::guard('teacher')->user()->id;

        $data =  new Task;

         if($data->validate($request->all(),"add")){
            return Redirect(env('teacher').'/student-task/add')->withErrors($data->validate($request->all(),"add"))->withInput();
        }

        $data->teacher_id = $teacher_id;

        $data->priority = $request->input('priority');


        $data->asg_student_id = $request->input('asg_student_id');

        $data->task_name = $request->input('task_name');

        $data->task_desc = $request->input('task_desc');
      
        $data->start_date = $request->input('start_date');
       
        $data->end_date = $request->input('end_date');

        $data->save();


        $u_task = new UserTask;

        $u_task->deadline = $request->input('end_date');
        $u_task->student_id = $request->input('asg_student_id');
        $u_task->type = 'Task';
        $u_task->task_id = $data->id;

        $u_task->save();

        
       return Redirect(env('teacher').'/student-task')->with('message','New Task Created Successfully.');

    }



    /*
    |------------------------------------------------------------------
    |   Task List Page - Member
    |------------------------------------------------------------------
    */
    public function MemberIndex(){


        $teacher_id = Auth::guard('teacher')->user()->id;

        
        $data = [
            'data' => Task::where('teacher_id', $teacher_id)->where('asg_student_id', null)->where('is_deleted','0')->whereDate('start_date', '>=' ,Carbon::today()->subDays(14)->toDateString())->get(),

            'teacher' => Teacher::where('is_deleted','0')->get(),
            'link' => env('teacher').'/team-members-task/'
        ];

        return View('teacher.task.team-members.index',$data);
    }


    /*
    |------------------------------------------------------------------
    |   Search Task List Page - Member
    |------------------------------------------------------------------
    */
    public function MemberIndexSearch(Request $request){


        $teacher_id = Auth::guard('teacher')->user()->id;

        
        $data = [
            'data' => Task::where('teacher_id', $teacher_id)->where('asg_student_id', null)->where('is_deleted','0')->whereBetween('end_date', [$request->get('from'), $request->get('to')])->get(),
            
            'teacher' => Teacher::where('is_deleted','0')->get(),
            'link' => env('teacher').'/team-members-task/'
        ];

        return View('teacher.task.team-members.search',$data);
    }


    /*
    |------------------------------------------------------------------
    |   Task Add Page - Team Member
    |------------------------------------------------------------------
    */
    public function createMemberTask()
    {

    $teacher_id = Auth::guard('teacher')->user()->id;

     $data = [
            'data' => new Task,
            'teacher' => Teacher::get(),
            'teacher_id' => $teacher_id,
            'link' => env('teacher').'/team-members-task/'
        ];

        return View('teacher.task.team-members.add',$data);

    }


    /*
    |------------------------------------------------------------------
    |   Task Data Store - Team Member
    |------------------------------------------------------------------
    */
    public function storeMemberTask(Request $request)
    {

        $teacher_id = Auth::guard('teacher')->user()->id;

        $data =  new Task;

         if($data->validate($request->all(),"add")){
            return Redirect(env('teacher').'/team-members-task/add')->withErrors($data->validate($request->all(),"add"))->withInput();
        }

        $data->teacher_id = $teacher_id;

        $data->priority = $request->input('priority');


        $data->asg_teacher_id = $request->input('asg_teacher_id');

        $data->task_name = $request->input('task_name');

        $data->task_desc = $request->input('task_desc');
      
        $data->start_date = $request->input('start_date');
       
        $data->end_date = $request->input('end_date');

        $data->approved = 'P';


        $data->save();

        
       return Redirect(env('teacher').'/team-members-task')->with('message','Task Created & Sent for Approval.');

    }


    /*
    |------------------------------------------------------------------
    |   Edit Task Page - Member
    |------------------------------------------------------------------
    */

    public function memberEdit($id)
    {


        $data = [
            'id' => $id,
            'data' => Task::findOrFail($id),
            'teacher' => Teacher::where('is_deleted', 0)->get(),
            'link' => env('teacher').'/team-members-task/'
        ];

        return View('teacher.task.team-members.edit',$data);
    }



    /*
    |------------------------------------------------------------------
    |   Update Task - Member
    |------------------------------------------------------------------
    */

    public function memberUpdate(Request $request, $id)

    {

        $teacher_id = Auth::guard('teacher')->user()->id;

        $data =  Task::findOrFail($id);


         if($data->validate($request->all(),"edit")){
            return Redirect(env('teacher').'/team-members-task/'.$id.'/edit')->withErrors($data->validate($request->all(),"edit"))->withInput();
        }


        $data->teacher_id = $teacher_id;

        $data->priority = $request->input('priority');

        $data->asg_teacher_id = $request->input('asg_teacher_id');

        $data->task_name = $request->input('task_name');

        $data->task_desc = $request->input('task_desc');
      

        $data->save();


       return Redirect(env('teacher').'/team-members-task')->with('message','Task Updated Successfully.');


    }


    /*
    |------------------------------------------------------------------
    |   Task Delete (Trash Data)
    |------------------------------------------------------------------
    */

    public function destroy($id)
    {
        //
        $data = Task::findOrFail($id);
        $data->is_deleted = 1;
        $data->save();

        return back()->with('message','Task Deleted Successfully.');
    }



    /*
    |------------------------------------------------------------------
    |   Edit Task Page - Student
    |------------------------------------------------------------------
    */

    public function StudentEdit($id)
    {

        $data = [
            'id' => $id,
            'data' => Task::findOrFail($id),
            //'teacher' => Teacher::where('is_deleted', 0)->get(),
            'student' => Student::where('is_deleted', 0)->get(),
            'link' => env('teacher').'/student-task/'
        ];

        return View('teacher.task.student.edit',$data);
    }



    /*
    |------------------------------------------------------------------
    |   Update Task - Student
    |------------------------------------------------------------------
    */

    public function studentUpdate(Request $request, $id)

    {

        $teacher_id = Auth::guard('teacher')->user()->id;
        $data =  Task::findOrFail($id);

         if($data->validate($request->all(),"edit")){
            return Redirect(env('teacher').'/student-task/'.$id.'/edit')->withErrors($data->validate($request->all(),"edit"))->withInput();
        }

        $data->teacher_id = $teacher_id;

        $data->priority = $request->input('priority');

        $data->asg_student_id = $request->input('asg_student_id');

        $data->task_name = $request->input('task_name');

        $data->task_desc = $request->input('task_desc');
      

        $data->save();


       return Redirect(env('teacher').'/student-task')->with('message','Task Updated Successfully.');


    }


    /*
    |------------------------------------------------------------------
    |   Extend Request Page - Self
    |------------------------------------------------------------------
    */
    public function ExtendRequest($id)
    {

        $teacher_id = Auth::guard('teacher')->user()->id;

        $data = UserTask::findOrFail($id);



        if ($data->has_request == 1) {


                $data = [
                
                    'link' => env('teacher').'/self-task/',

                    ];
                        return View('teacher.task.self.ex_pending', $data);
            }

        $data = [
            'id' => $id,
            'data' => $data,
            'task' => Task::get(),
            'gtask' => GlobalTask::get(),
            'teacher' => Teacher::get(),
            'link' => env('teacher').'/self-task/'
        ];

        return View('teacher.task.self.extend',$data);
    }



    /*
    |------------------------------------------------------------------
    |   Extend Time Submit - Student
    |------------------------------------------------------------------
    */
    public function ExRequest_Submit(Request $request, $id)
    {

        $data = UserTask::findOrFail($id);

   if($data->validate($request->all(),"extend")){
            return Redirect(env('teacher').'/self-task/'.$id.'/extend')->withErrors($data->validate($request->all(),"extend"))->withInput();
        }


        if ($data->teacher_id == Auth::guard('teacher')->user()->id) {
       
        $data->ex_date = $request->get('ex_date');

        $data->ex_reason = $request->get('ex_reason');

        $data->has_request = 1;

        $data->save();


        return Redirect(env('teacher').'/self-task')->with('message','Request Submitted Successfully.');

    }

        return back()->with('error','You Dont Have Access To This.');


    }


    /*
    |------------------------------------------------------------------
    |   Proof Submit - Page
    |------------------------------------------------------------------
    */
    public function SendProofPage($id)
    {


        $u_task = UserTask::findOrFail($id);
        $teacher_id = Auth::guard('teacher')->user()->id;


    if ($u_task->proof) {


        $data = [
        
            'link' => env('teacher').'/self-task/',

            ];
                return View('teacher.task.self.submitted', $data);
        }

        $data = [
            'id' => $id,
            'data' => $u_task,
            'task' => Task::get(),
            'gtask' => GlobalTask::get(),
            'today' => Carbon::today()->toDateString(),
            'link' => env('teacher').'/self-task/'
        ];

        return View('teacher.task.self.proof_submit',$data);
    }


    /*
    |------------------------------------------------------------------
    |   Proof Submit
    |------------------------------------------------------------------
    */


    public function SendProof(Request $request, $id)


    {

        $teacher_id = Auth::guard('teacher')->user()->id;
        $data = UserTask::findOrFail($id);
        $task = Task::findOrFail($data->task_id);

        $data->remark = $request->input('remark');

        $data->completed_at = Carbon::today();

        $proof = time().'.'.request()->proof->getClientOriginalExtension();
        
        $data->proof = $proof;

        request()->proof->move("upload/task_proof/", $proof);

        $data->save();

        return Redirect(env('teacher').'/self-task')->with('message','Proof Submitted Successfully.');

    }


}
