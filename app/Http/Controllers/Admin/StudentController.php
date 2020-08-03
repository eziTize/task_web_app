<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Student;
//use App\Branch;
use App\Task;
use App\TaskComment;

class StudentController extends Controller
{
    /*
    |------------------------------------------------------------------
    |   Student List Page
    |------------------------------------------------------------------
    */
    public function index(){
        $data = [
            'data' => Student::where('is_deleted','0')->get(),
            //'branch' => new Branch,
            'task' => new Task,
            'link' => env('admin').'/student/'
        ];

        return View('admin.users.student.index',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Student Add Page
    |------------------------------------------------------------------
    */
    public function show(){
        $data = [
            'data' => new Student,
           // 'branch' => Branch::where('is_deleted','0')->pluck('name','id'),
            'link' => env('admin').'/student/'
        ];

        return View('admin.users.student.add',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Student Data Store
    |------------------------------------------------------------------
    */
    public function store(Request $request){
        $data = new Student;

        if($data->validate($request->all(),"add")){
            return Redirect(env('admin').'/student/add')->withErrors($data->validate($request->all(),"add"))->withInput();
        }elseif($data->duplicateChk("add",$request)){
            return Redirect(env('admin').'/student/add')->with('error','Sorry! '.$data->duplicateChk("add",$request).' Already Exists')->withInput();
        }

       // $data->branch_id = $request->get('branch_id');
        $data->name = $request->get('name');
        $data->gender = $request->get('gender');
        $data->email = strtolower($request->get('email'));
        $data->phone = $request->get('phone');
        $data->password = bcrypt($request->get('password'));
        $data->address = $request->get('address');
        $data->status = $request->get('status');
        $data->save();

        return Redirect(env('admin').'/student')->with('message','New Student Added Successfully.');
    }

    /*
    |------------------------------------------------------------------
    |   Edit Student Page
    |------------------------------------------------------------------
    */
    public function edit($id){
        $data = [
            'id' => $id,
            'data' => Student::find($id),
          //  'branch' => Branch::pluck('name','id'),
            'link' => env('admin').'/student/'
        ];

        return View('admin.users.student.edit',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Student Data Update
    |------------------------------------------------------------------
    */
    public function update(Request $request,$id){
        $data = Student::find($id);

        if($data->validate($request->all(),"edit")){
            return Redirect(env('admin').'/student/'.$id.'/edit')->withErrors($data->validate($request->all(),"edit"))->withInput();
        }elseif($data->duplicateChk("edit",$request,$id)){
            return Redirect(env('admin').'/student/'.$id.'/edit')->with('error','Sorry! '.$data->duplicateChk("edit",$request,$id).' Already Exists')->withInput();
        }

      //  $data->branch_id = $request->get('branch_id');
        $data->name = $request->get('name');
        $data->gender = $request->get('gender');
        $data->email = strtolower($request->get('email'));
        $data->phone = $request->get('phone');
        $data->address = $request->get('address');
        $data->status = $request->get('status');
        
        if($request->get('password')){
            $data->password = bcrypt($request->get('password'));
        }

        $data->save();

        return Redirect(env('admin').'/student')->with('message','Student Updated Successfully.');
    }

    /*
    |------------------------------------------------------------------
    |   Student Data Delete
    |------------------------------------------------------------------
    */
    public function destroy($id){
        $data = Student::find($id);
        $data->is_deleted = 1;
        $data->save();

        return Redirect(env('admin').'/student')->with('message','Student Deleted Successfully.');
    }

    /*
    |------------------------------------------------------------------
    |   Student Trash List Page
    |------------------------------------------------------------------
    */
    public function trash(){
        $data = [
            'data' => Student::where('is_deleted','1')->get(),
          //  'branch' => new Branch,
            'link' => env('admin').'/student/'
        ];

        return View('admin.users.student.trash',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Student Data Restore
    |------------------------------------------------------------------
    */
    public function restore($id){
        $data = Student::find($id);
        $data->is_deleted = 0;
        $data->save();

        return Redirect(env('admin').'/student/trash')->with('message','Student Restored Successfully.');
    }

    /*
    |------------------------------------------------------------------
    |   Student Data Delete Parmanently
    |------------------------------------------------------------------
    */
    public function destroyPermanent($id){
        $data = Student::find($id);
        $data->delete();

        return Redirect(env('admin').'/student/trash')->with('message','Student Deleted Successfully.');
    }

    /*
    |------------------------------------------------------------------
    |   Add Task Page for Student
    |------------------------------------------------------------------
    */
    public function addTask($id){
        $data = [
            'data' => Task::where('student_id',$id)->where('status','0')->first() ?? new Task,
            'student' => Student::find($id),
            'task_comment' => new TaskComment,
            'link' => env('admin').'/student/'
        ];

        return View('admin.users.student.add_task',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Task Store for Student
    |------------------------------------------------------------------
    */
    public function addTaskStore(Request $request,$id){
        $data = Task::where('student_id',$id)->where('status','0')->first() ?? new Task;
        $student = Student::find($id);

        if($data->validate($request->all())){
            return Redirect(env('admin').'/student/'.$id.'/add_task')->withErrors($data->validate($request->all()))->withInput();
        }

        $data->student_id = $id;
        $data->task_desc = $request->get('task_desc');
        $data->start_date = $request->get('start_date');
        $data->end_date = $request->get('end_date');
        $data->save();

        return Redirect(env('admin').'/student/'.$id.'/add_task')->with('message','Task Added on '.$student->name.' Successfully.');
    }

    /*
    |------------------------------------------------------------------
    |   Finish Task for Student
    |------------------------------------------------------------------
    */
    public function finishTask(Request $request,$id){
        $student = Student::find($id);
        $data = Task::where('student_id',$id)->where('status','0')->update(['status' => '1']);

        return Redirect(env('admin').'/student')->with('message','Task Finished on '.$student->name.' Successfully.');
    }
}
