<?php

namespace App\Http\Controllers\Teacher;

use App\Work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;
use Carbon\Carbon;

class WorkController extends Controller
{
   

    /*
    |------------------------------------------------------------------
    | List Work Page
    |------------------------------------------------------------------
    */
    public function index(){


        $teacher_id = Auth::guard('teacher')->user()->id;

        
        $data = [
            'data' => Work::where('teacher_id', $teacher_id)->whereDate('start_date', '>=' ,Carbon::today()->toDateString())->get(),
            'link' => env('teacher').'/work-log/',
            'today' => Carbon::today()->toDateString(),
//            'yesterday' => Carbon::today()->subDays(1)->format('d-m-y'),
            'past' => Carbon::today()->subDays(2)->format('d-m-y'),
        ];

        return View('teacher.work.index',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Work Add Page
    |------------------------------------------------------------------
    */

    public function create()
    {

     $data = [
            'data' => new Work,
            'link' => env('teacher').'/work-log/'


        ];

        return View('teacher.work.add',$data);

    }

   
    /*
    |------------------------------------------------------------------
    |   Work Data Store
    |------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $teacher_id = Auth::guard('teacher')->user()->id;

        $input = $request->all();

         if($request->name){
            foreach($request->name as $key=>$value){
                Work::Create(array(

                    'teacher_id' => $teacher_id,
                    'name' => $value,
                    'desc' => $input['desc'][$key],
                    'start_date' => $input['start_date'][$key],
                    'started_at' => $input['started_at'][$key],
                    'ended_at' => $input['ended_at'][$key],
                ));
            }

            return Redirect(env('teacher').'/work-log')->with('message','Work Added To Work Log.');

        }

         return Redirect(env('teacher').'/work-log')->with('error','No Work Submitted.');


    }


     /*
    |------------------------------------------------------------------
    |    Log Field Add
    |------------------------------------------------------------------
    */

    public function addLog(){
        return View('teacher.work.log_field');
    }
    
    /*
    |------------------------------------------------------------------
    |   Log Field Delete
    |------------------------------------------------------------------
    */

    public function delete_Log($id){
        Work::deleteLog($id);

        return Redirect::back()->with('message','Removed Successfully.');
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
            'link' => env('teacher').'/work-log/',
            'today' => Carbon::today()->format('d-m-y'),
//            'yesterday' => Carbon::today()->subDays(1)->format('d-m-y'),
            'past' => Carbon::today()->subDays(2)->format('d-m-y'),

        ];

        return View('teacher.work.edit',$data);

    }

    /*
    |------------------------------------------------------------------
    |   Update Work Page
    |------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {

       $teacher_id = Auth::guard('teacher')->user()->id;

         $data =  Work::findOrFail($id);

         if($data->validate($request->all(),"edit")){
            return Redirect(env('teacher').'/work-log/edit')->withErrors($data->validate($request->all(),"edit"))->withInput();
        }

        $data->teacher_id = $teacher_id;

        $data->name = $request->input('name');
        $data->desc = $request->input('desc');
        $data->started_at = $request->input('started_at');
        $data->ended_at = $request->input('ended_at');

        $data->save();

        return Redirect(env('teacher').'/work-log')->with('message','Work Updated Successfully.');

    }


    /*
    |------------------------------------------------------------------
    |   End Task
    |------------------------------------------------------------------
    */
    public function endWork(Request $request, $id)
    {

       $teacher_id = Auth::guard('teacher')->user()->id;

        $data =  Work::findOrFail($id);

    if ( $teacher_id == $data->teacher_id){

        $data->ended_at = now();

        $data->save();

        return Redirect(env('teacher').'/work-log')->with('message','Work Ended Successfully.');


    }


    return back()->withErros('You do not have access to this!');

       

    }

    /*
    |------------------------------------------------------------------
    |   Work Index - Search
    |------------------------------------------------------------------
    */

    public function indexSearch(Request $request){

    
    $teacher_id = Auth::guard('teacher')->user()->id;
    $work = Work::where('teacher_id', $teacher_id)->whereBetween('start_date', [$request->get('from'), $request->get('to')])->get();

        $data = [
            'data' => $work,
            'link' => env('teacher').'/work-log/',
            'from' => $request->get('from'),
            'to' => $request->get('to'),
            'today' => Carbon::today()->toDateString(),
        ];


        return View('teacher.work.search',$data);


    }

}
