<?php

namespace App\Http\Controllers\Teacher;

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
        
        $teacher_id = Auth::guard('teacher')->user()->id;

         $data = [
            'data' => Notification::where('teacher_id', $teacher_id)->get(),
            'link' => env('teacher').'/notifications/'
        ];
        return View('teacher.notifications.index',$data);
    }


    /*
    |------------------------------------------------------------------
    |   Delete Notification
    |------------------------------------------------------------------
    */
    public function destroy($id){

        $data = Notification::find($id);
        $data->delete();

        return Redirect(env('teacher').'/notifications');
    }

}
