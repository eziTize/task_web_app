<?php

namespace App\Http\Controllers\Admin;

use App\Work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;
use Carbon\Carbon;
use App\Teacher;

class WorkController extends Controller
{
   

    /*
    |------------------------------------------------------------------
    | List Work Page
    |------------------------------------------------------------------
    
    public function index(){


        $admin_id = Auth::guard('admin')->user()->id;

        
        $data = [
            'data' => Work::where('teacher_id', $teacher_id)->whereDate('start_date', '>=' ,Carbon::today()->toDateString())->get(),
            'link' => env('teacher').'/work-log/',
            'today' => Carbon::today()->format('d-m-y'),
//            'yesterday' => Carbon::today()->subDays(1)->format('d-m-y'),
            'past' => Carbon::today()->subDays(2)->format('d-m-y'),
        ];

        return View('teacher.work.index',$data);
    }
*/

    /*
    |------------------------------------------------------------------
    |   Work Index - Search
    |------------------------------------------------------------------
    */

    public function workSearch(Request $request){

    
    $admin_id = Auth::guard('admin')->user()->id;

    $user_s = $request->input('user_id');
    $from_s = [$request->get('from'), $request->get('to')];


      /*$work = Work::where(function($query) use ($user_s) ($from_s){
        $query->where('teacher_id', $user_s)->whereBetween('start_date', $from_s);
    })->orWhere(function($query) use ($from_s) {
        $query->whereBetween('start_date', $from_s);
    })->get();*/

    $work = Work::where('teacher_id', $request->get('user_id'))->whereBetween('start_date', [$request->get('from'), $request->get('to')])->get();


        $data = [
            'data' => $work,
            'link' => env('admin').'/work-log/',
            'from' => $request->get('from'),
            'to' => $request->get('to'),
            'user_id' => $request->get('user_id'),
            'teacher' => Teacher::get(),
        ];


        return View('admin.work.search',$data);


    }


    /*
    |------------------------------------------------------------------
    |   Edit Work Page
    |------------------------------------------------------------------
    */
    public function edit($id)
    {
        $data = [
            'id' => $id,
            'data' => Work::findOrFail($id),
            'link' => env('admin').'/work-log/',
            'today' => Carbon::today()->format('d-m-y'),
            'past' => Carbon::today()->subDays(2)->format('d-m-y'),
            'teacher' => Teacher::get(),


        ];

        return View('admin.work.edit',$data);

    }

    /*
    |------------------------------------------------------------------
    |   Update Work Page
    |------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {

         $data =  Work::findOrFail($id);

         if($data->validate($request->all(),"edit")){
            return Redirect(env('admin').'/work-log/edit')->withErrors($data->validate($request->all(),"edit"))->withInput();
        }

        $data->teacher_id = $data->teacher_id;

        $data->name = $request->input('name');
        $data->desc = $request->input('desc');
        $data->started_at = $request->input('started_at');
        $data->ended_at = $request->input('ended_at');

        $data->save();

        return Redirect(env('admin').'/work-log')->with('message','Work Updated Successfully.');

    }


    /*
    |------------------------------------------------------------------
    |   Delete Work
    |------------------------------------------------------------------
    */
    public function destroyPermanent($id)
    {

        $data =  Work::findOrFail($id);
        $data->delete();

        return back()->with('message','Work Deleted Successfully.');

    }


}
