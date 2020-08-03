<?php

namespace App\Http\Controllers\Student;

use App\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;



class NotificationController extends Controller
{
   

    /*
    |------------------------------------------------------------------
    |   Notifictions List Page
    |------------------------------------------------------------------
    */
    public function index()
    {
        
        $student_id = Auth::guard('student')->user()->id;

         $data = [
            'data' => Notification::where('student_id', $student_id)->get(),
            'link' => env('student').'/notifications/'
        ];
        return View('student.notifications.index',$data);
    }


    /*
    |------------------------------------------------------------------
    |   Delete Notification
    |------------------------------------------------------------------
    */
    public function destroy($id){

        $data = Notification::find($id);
        $data->delete();

        return Redirect(env('student').'/notifications');
    }

}
