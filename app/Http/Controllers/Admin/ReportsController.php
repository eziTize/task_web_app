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

class ReportsController extends Controller
{

    /*
    |------------------------------------------------------------------
    |   Reports Index - Student
    |------------------------------------------------------------------
    */
    	
    	public function student_index(){


    	 $data = [
            'data' => Student::where('is_deleted','0')->get(),
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
        
        public function teacher_index(){


         $data = [
            'data' => Teacher::where('is_deleted','0')->get(),
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



        $u_tasks = UserTask::get();

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

    
    $u_tasks = UserTask::whereBetween('created_at', [$request->get('from'), $request->get('to')])->get();

        $data = [
            'student' => Student::where('is_deleted','0')->get(),
            'teacher' => Teacher::where('is_deleted','0')->get(),
            'data' => $u_tasks,
            'task' => Task::get(),
            'gtask' => GlobalTask::get(),
            'link' => env('admin').'/reports-all/'
        ];

        return View('admin.reports.all.search',$data);

    }


}


