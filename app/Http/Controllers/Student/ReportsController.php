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
use App\GlobalTask;
use Redirect;

class ReportsController extends Controller
{

    /*
    |------------------------------------------------------------------
    |   Reports Index
    |------------------------------------------------------------------
    */
    	
    	public function index(){


    	$student_id = Auth::guard('student')->user()->id;

    	$u_tasks = UserTask::where('student_id', $student_id)->get();

        
        $data = [
            'data' => $u_tasks,
            'task' => Task::get(),
            'gtask' => GlobalTask::get(),
            'link' => env('student').'/reports/'
        ];

        return View('student.reports.index',$data);

    }




    /*
    |------------------------------------------------------------------
    |   Reports Index - Search
    |------------------------------------------------------------------
    */

    public function indexSearch(Request $request){

    
    $student_id = Auth::guard('student')->user()->id;
    $u_tasks = UserTask::where('student_id', $student_id)->whereBetween('created_at', [$request->get('from'), $request->get('to')])->get();

        $data = [
            'data' => $u_tasks,
            'task' => Task::get(),
            'gtask' => GlobalTask::get(),
            'link' => env('student').'/reports/'
        ];


        return View('student.reports.search',$data);


    }



}


