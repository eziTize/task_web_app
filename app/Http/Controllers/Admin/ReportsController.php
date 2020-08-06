<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Task;
use App\Admin;
use App\Student;
use App\Teacher;
use App\UserTask;
use App\GlobalTask;
use Redirect;
use Carbon\Carbon;

class ReportsController extends Controller
{

    /*
    |------------------------------------------------------------------
    |   Reports Index - Student
    |------------------------------------------------------------------
    */
    	
    	public function student_index(Request $request){


        if($request->get('user_id'))
        {

            $data = Student::where('is_deleted','0')->where('id', $request->get('user_id'))->get();

        }

        else{

            $data = Student::where('is_deleted','0')->get();
        }


    	 $data = [
            'data' => $data,
            'students' => Student::get(),
            'link' => env('admin').'/student-reports/'
        ];

        return View('admin.reports.student.index',$data);


    }



	
	/*
    |------------------------------------------------------------------
    |   Individual Student Report Page
    |------------------------------------------------------------------
    */
    	
    	public function student_report($id){


    	$u_tasks = UserTask::where('student_id', $id)->get();

        
        $data = [
            'id'   => $id,
            'student' => Student::findOrFail($id),
            'data' => $u_tasks,
            'task' => Task::get(),
            'gtask' => GlobalTask::get(),
            'link' => env('admin').'/student-reports/'
        ];

        return View('admin.reports.student.t_index',$data);

    }



    /*
    |------------------------------------------------------------------
    |   Reports Index - Student Search
    |------------------------------------------------------------------
    */

    public function student_Search(Request $request, $id){

    
    $u_tasks = UserTask::where('student_id', $id)->whereBetween('created_at', [$request->get('from'), $request->get('to')])->get();

        $data = [
            'id'   => $id,
            'student' => Student::findOrFail($id),
            'data' => $u_tasks,
            'task' => Task::get(),
            'gtask' => GlobalTask::get(),
            'link' => env('admin').'/student-reports/'
        ];

        return View('admin.reports.student.search',$data);

    }



    /*
    |------------------------------------------------------------------
    |   Reports Index - Teacher
    |------------------------------------------------------------------
    */
        
        public function teacher_index(Request $request){


            if($request->get('user_id'))
        {

            $data = Teacher::where('is_deleted','0')->where('id', $request->get('user_id'))->get();

        }

        else{

            $data = Teacher::where('is_deleted','0')->get();
        }


         $data = [
            'data' => $data,
            'teachers' => Teacher::get(),
            'link' => env('admin').'/team-member-reports/'
        ];

        return View('admin.reports.teacher.index',$data);

    }
    
    
    /*
    |------------------------------------------------------------------
    |   Individual Teacher Report Page
    |------------------------------------------------------------------
    */
        
        public function teacher_report($id){


        $u_tasks = UserTask::where('teacher_id', $id)->get();

        
        $data = [
            'id'   => $id,
            'teacher' => Teacher::findOrFail($id),
            'data' => $u_tasks,
            'task' => Task::get(),
            'gtask' => GlobalTask::get(),
            'link' => env('admin').'/team-member-reports/'
        ];

        return View('admin.reports.teacher.t_index',$data);

    }



    /*
    |------------------------------------------------------------------
    |   Reports Index - Teacher Search
    |------------------------------------------------------------------
    */

    public function teacher_Search(Request $request, $id){

    
    $u_tasks = UserTask::where('teacher_id', $id)->whereBetween('created_at', [$request->get('from'), $request->get('to')])->get();

        $data = [
            'id'   => $id,
            'teacher' => Teacher::findOrFail($id),
            'data' => $u_tasks,
            'task' => Task::get(),
            'gtask' => GlobalTask::get(),
            'link' => env('admin').'/team-member-reports/'
        ];

        return View('admin.reports.teacher.search',$data);

    }




    /*
    |------------------------------------------------------------------
    |   All Reports Index
    |------------------------------------------------------------------
    */
        
        public function report_all(){

        $u_tasks = UserTask::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();

         $data = [
            'student' => Student::where('is_deleted','0')->get(),
            'teacher' => Teacher::where('is_deleted','0')->get(),
            'data' => $u_tasks,
            'task' => Task::get(),
            'gtask' => GlobalTask::get(),
            'link' => env('admin').'/reports-all/'
        ];

        return View('admin.reports.all.index',$data);

    }


    /*
    |------------------------------------------------------------------
    |   All Reports - Search
    |------------------------------------------------------------------
    */

    public function Search_all(Request $request){


     $admin_id = Auth::guard('admin')->user()->id;


    // If Both Student & Team Member
    
    if($request->get('teacher_id') && $request->get('student_id')){

      return back()->with('error','Cannot Search For Both Student & Team Member at the Same Time');

    }


    // If All Null
    elseif($request->get('teacher_id') == null && $request->get('student_id') == null && $request->get('from') == null && $request->get('to') == null){

        return back()->with('error','Please Enter A Search Parameter');

    }



    else{

    //Member Search
    if($request->get('teacher_id')){

        if($request->get('teacher_id') && $request->get('to') && $request->get('from')){

        $u_tasks = UserTask::where('teacher_id', $request->get('teacher_id'))->whereBetween('deadline', [$request->get('from'), $request->get('to')])->get();
        
        }


        elseif($request->get('teacher_id') && $request->get('to') && $request->get('from') == null){

            $u_tasks = UserTask::where('teacher_id', $request->get('teacher_id'))->where('deadline', $request->get('to'))->get();
        }

        elseif($request->get('teacher_id') && $request->get('from') && $request->get('to') == null){

            $u_tasks = UserTask::where('teacher_id', $request->get('teacher_id'))->where('deadline', $request->get('from'))->get();
        }

         else{

            $u_tasks = UserTask::where('teacher_id', $request->get('teacher_id'))->get();
        }

    }
    
    //Student Search

    elseif($request->get('student_id')){

        if($request->get('student_id') && $request->get('to') && $request->get('from')){

        $u_tasks = UserTask::where('student_id', $request->get('student_id'))->whereBetween('deadline', [$request->get('from'), $request->get('to')])->get();
        
        }

        elseif($request->get('student_id') && $request->get('to') && $request->get('from') == null){

            $u_tasks = UserTask::where('student_id', $request->get('student_id'))->where('deadline', $request->get('to'))->get();
        }

        elseif($request->get('student_id') && $request->get('from') && $request->get('to') == null){

            $u_tasks = UserTask::where('student_id', $request->get('student_id'))->where('deadline', $request->get('from'))->get();
        }


        else{

            $u_tasks = UserTask::where('student_id', $request->get('student_id'))->get();
        }

    }


    // Only To & From
    elseif($request->get('to') && $request->get('from')){

            $u_tasks = UserTask::whereBetween('deadline', [$request->get('from'), $request->get('to')])->get();

        }

    // Only From

    elseif($request->get('from') && $request->get('to') == null){


            $u_tasks = UserTask::where('deadline', $request->get('from'))->get();

    }

    //Only To

    elseif($request->get('to') && $request->get('from') == null){


            $u_tasks = UserTask::where('deadline', $request->get('to'))->get();


    }

        $data = [
            'student' => Student::where('is_deleted','0')->get(),
            'teacher' => Teacher::where('is_deleted','0')->get(),
            'data' => $u_tasks,
            'task' => Task::get(),
            'gtask' => GlobalTask::get(),
            'from' => $request->get('from'),
            'to' => $request->get('to'),
            'teacher_id' => $request->get('teacher_id'),
            'student_id' => $request->get('student_id'),
            'link' => env('admin').'/approve-requests/'
        ];

        return View('admin.task.search',$data);
    }

  }


}


