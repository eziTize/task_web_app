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
use Redirect;
use Carbon\Carbon;

class ReportsController extends Controller
{

    /*
    |------------------------------------------------------------------
    |   Reports Index
    |------------------------------------------------------------------
    */
    	
    	public function index(){

  
        $data = [
            'data' => UserTask::where(function($query){
                $query->where('teacher_id', Auth::guard('teacher')->user()->id)->where('status', 'Approved')->whereDate('deadline', '>=' ,Carbon::now()->subDays(10));
            })->orWhere(function($query){
                $query->where('teacher_id', Auth::guard('teacher')->user()->id)->where('status', '!=', 'Approved');
            })->get(),

            'task' => Task::get(),
            'gtask' => GlobalTask::get(),
            'link' => env('teacher').'/reports/'
        ];

        return View('teacher.reports.index',$data);

    }



    /*
    |------------------------------------------------------------------
    |   Reports Index - Search
    |------------------------------------------------------------------
    */

    public function indexSearch(Request $request){

    
    $teacher_id = Auth::guard('teacher')->user()->id;
    $u_tasks = UserTask::where('teacher_id', $teacher_id)->whereBetween('deadline', [$request->get('from'), $request->get('to')])->get();

        $data = [
            'data' => $u_tasks,
            'task' => Task::get(),
            'gtask' => GlobalTask::get(),
            'link' => env('teacher').'/reports/'
        ];


        return View('teacher.reports.search',$data);


    }
    
}


