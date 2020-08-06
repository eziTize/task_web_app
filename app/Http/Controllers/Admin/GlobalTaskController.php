<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Student;
use App\Teacher;
use App\UserTask;
use App\GlobalTask;
use App\Admin;
use App\Branch;
use App\Subject;
use App\InvGtask;
use App\TmbrBranch;
use App\TmbrSubject;
use Carbon\Carbon;
use Response;
use Redirect;

class GlobalTaskController extends Controller
{
    /*
    |------------------------------------------------------------------
    |   GlobalTask List Page
    |------------------------------------------------------------------
    */
    public function index(Request $request){




    $admin_id = Auth::guard('admin')->user()->id;



    if($request->get('to') && $request->get('from')){

        $data = GlobalTask::where('admin_id', $admin_id)->whereBetween('start_date', [$request->get('from'), $request->get('to')])->where('is_deleted','0')->get();
    }


    elseif($request->get('to') && $request->get('from') == null){

        $data = GlobalTask::where('admin_id', $admin_id)->where('start_date', $request->get('to'))->where('is_deleted','0')->get();

    }


    elseif($request->get('to') == null && $request->get('from')){

        $data = GlobalTask::where('admin_id', $admin_id)->where('start_date', $request->get('from'))->where('is_deleted','0')->get();

    }


    else{

        $data = GlobalTask::where('admin_id', $admin_id)->where('is_deleted','0')->whereDate('start_date', '>=' ,Carbon::today()->subDays(14)->toDateString())->get();

    }

        
        $data = [
            'data' => $data,
            'link' => env('admin').'/g-task/'
        ];

        return View('admin.g_task.index',$data);
    
}



    /*
    |------------------------------------------------------------------
    |   GlobalTask Add Page
    |------------------------------------------------------------------
    */
    public function create()
    {

     $data = [
            'data' => new GlobalTask,
            //'inv_gtask' => new InvGtask,
            'branch' => Branch::where('is_deleted','0')->get(),
            'subject' => Subject::where('is_deleted','0')->get(),

            'link' => env('admin').'/g-task/'
        ];

        return View('admin.g_task.add',$data);

    }



    /*
    |------------------------------------------------------------------
    |   GlobalTask Data Store
    |------------------------------------------------------------------
    */
    public function store(Request $request)
    {

        $admin_id = Auth::guard('admin')->user()->id;

        $teachers = Teacher::where('is_deleted','0')->get();


        $data = new GlobalTask;

        if($data->validate($request->all(),"add")){
            return Redirect(env('admin').'/g-task/add')->withErrors($data->validate($request->all(),"add"))->withInput();
        }
        

        $data->admin_id = $admin_id;

        $data->priority = $request->input('priority');

        $data->task_name = $request->input('task_name');

        $data->task_desc = $request->input('task_desc');
      
        $data->start_date = $request->input('start_date');
       
        $data->end_date = $request->input('end_date');

        $data->save();
   



        $input = $request->all();

         if($request->branch_id){
            foreach($request->branch_id as $key=>$value){


                    if($value == 'All'){

                      if( $value == 'All' && ($input['subject_id'][$key]) == 'All'){


                        InvGtask::Create(array(
                            'gtask_id' => $data->id,
                            'branches' => 'all',
                            'subjects' => 'all',
                            ));

                        foreach($teachers as $teacher){

                        if(TmbrBranch::where('teacher_id', $teacher->id)->where('status', 'Y')->count() > 0){

                        if(UserTask::where('teacher_id', $teacher->id)->where('gtask_id', $data->id)->count() == 0){
                                
                        $u_task = UserTask::Create(array(
                                    'deadline' => $request->input('end_date'),
                                    'teacher_id'  => $teacher->id,
                                    'type' => 'G-Task',
                                    'gtask_id' => $data->id,
                                    
                        ));

                       }
                    }
                 
                }
            }


                elseif($value == 'All' && ($input['subject_id'][$key]) != 'All'){


                    InvGtask::Create(array(
                        'gtask_id' => $data->id,
                            'branches' => 'all',
                            'subject_id' => $input['subject_id'][$key],
                            ));


                    foreach($teachers as $teacher){

                    if(TmbrBranch::where('teacher_id', $teacher->id)->where('status', 'Y')->count() > 0 && TmbrSubject::where('teacher_id', $teacher->id)->where('subject_id', ($input['subject_id'][$key]) )->where('status', 'Y')->count() > 0){

                        if(UserTask::where('teacher_id', $teacher->id)->where('gtask_id', $data->id)->count() == 0){

                         $u_task = UserTask::Create(array(
                                    'deadline' => $request->input('end_date'),
                                    'teacher_id'  => $teacher->id,
                                    'type' => 'G-Task',
                                    'gtask_id' => $data->id,
                        ));

                       }

                     }

                   }
                }

            }


            elseif($value != 'All' && ($input['subject_id'][$key]) != 'All'){


                InvGtask::Create(array(
                            'gtask_id' => $data->id,
                            'branch_id' => $value,
                            'subject_id' => $input['subject_id'][$key],
                            ));

                    foreach($teachers as $teacher){

                    if(TmbrBranch::where('teacher_id', $teacher->id)->where('branch_id', $value)->where('status', 'Y')->count() > 0 && TmbrSubject::where('teacher_id', $teacher->id)->where('subject_id', ($input['subject_id'][$key]) )->where('status', 'Y')->count() > 0){


                        if(UserTask::where('teacher_id', $teacher->id)->where('gtask_id', $data->id)->count() == 0){

                                $u_task = UserTask::Create(array(
                                                'deadline' => $request->input('end_date'),
                                                'teacher_id'  => $teacher->id,
                                                'type' => 'G-Task',
                                                'gtask_id' => $data->id,
                                              
                                    ));

                            }
                    }
                  }

                }

                elseif($value != 'All' && ($input['subject_id'][$key]) == 'All'){


                    InvGtask::Create(array(
                        'gtask_id' => $data->id,
                            'branch_id' => $value,
                            'subjects' => 'all',
                            ));

                    foreach($teachers as $teacher){

                if(TmbrBranch::where('teacher_id', $teacher->id)->where('branch_id', $value)->where('status', 'Y')->count() > 0 && TmbrSubject::where('teacher_id', $teacher->id)->where('status', 'Y')->count() > 0){

                    if(UserTask::where('teacher_id', $teacher->id)->where('gtask_id', $data->id)->count() == 0){

                                        $u_task = UserTask::Create(array(
                                                                'deadline' => $request->input('end_date'),
                                                                'teacher_id'  => $teacher->id,
                                                                'type' => 'G-Task',
                                                                'gtask_id' => $data->id,
                                                            
                                                    ));
                                        }
                            }

                    }
                }

        }
    }

       return Redirect(env('admin').'/g-task')->with('message','Global Task Created Successfully.');

}


    /*
    |------------------------------------------------------------------
    |   Select Field Add
    |------------------------------------------------------------------
    */
    public function addSelectField(){

        return View('admin.g_task.select_field');
    }
    
    /*
    |------------------------------------------------------------------
    |   Select Field Delete
    |------------------------------------------------------------------
    */
    public function deleteSelectField($id){

        $inv_gtask = InvGtask::findOrFail($id);
        $inv_gtask->delete();

        return Redirect::back()->with('message','Removed Successfully.');
    }



    /*
    |------------------------------------------------------------------
    |   GlobalTask Delete (Trash Data)
    |------------------------------------------------------------------
    */
    public function destroy($id)
    {
        //
        $data = GlobalTask::findOrFail($id);
        $data->is_deleted = 1;
        $data->save();

        return back()->with('message','Task Deleted Successfully.');
    }

    /*
    |------------------------------------------------------------------
    |   GlobalTask Trash List Page
    |------------------------------------------------------------------
    */
    public function trash(){
        
        $data = [
            'data' => GlobalTask::where('is_deleted','1')->get(),           
            'link' => env('admin').'/g-task/',
            'admin' => Admin::get(),
            'teacher' => Teacher::get(),
        ];

        return View('admin.g_task.trash',$data);
    }


    /*
    |------------------------------------------------------------------
    |   GlobalTask Data Restore
    |------------------------------------------------------------------
    */
    public function restore($id){
        
        $data = GlobalTask::findOrFail($id);
        $data->is_deleted = false;
        $data->save();

        return back()->with('success_message','Task Restored Successfully.');

    }

    /*
    |------------------------------------------------------------------
    |   GlobalTask Data Delete (Permanent)
    |------------------------------------------------------------------
    */
    public function destroyPermanent($id){
        $data = GlobalTask::findOrFail($id);
        $data->delete();

        return back()->with('message','Task Deleted Successfully.');

    }

    /*
    |------------------------------------------------------------------
    |   Edit GlobalTask Page
    |------------------------------------------------------------------
    */
    public function edit($id)
    {

        $data = [
            'id' => $id,
            'data' => GlobalTask::findOrFail($id),
            'inv_gtasks' => InvGtask::where('gtask_id',$id)->get(),
             'branch' => Branch::where('is_deleted','0')->get(),
            'subject' => Subject::where('is_deleted','0')->get(),
            'link' => env('admin').'/g-task/'
        ];

        return View('admin.g_task.edit',$data);
    }


    /*
    |------------------------------------------------------------------
    |   Update GlobalTask
    |------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {


        $admin_id = Auth::guard('admin')->user()->id;

        $data =  GlobalTask::findOrFail($id);

        $teachers = Teacher::where('is_deleted','0')->get();


        if($data->validate($request->all(),"edit")){
            return Redirect(env('admin').'/g-task/'.$id.'/edit')->withErrors($data->validate($request->all(),"edit"))->withInput();
        }

        $data->admin_id = $admin_id;

        $data->task_name = $request->input('task_name');
        $data->priority = $request->input('priority');
        $data->task_desc = $request->input('task_desc');

        $data->save();


        $input = $request->all();

         if($request->branch_id){
            foreach($request->branch_id as $key=>$value){


                    if($value == 'All'){

                      if( $value == 'All' && ($input['subject_id'][$key]) == 'All'){


                        InvGtask::Create(array(
                            'gtask_id' => $data->id,
                            'branches' => 'all',
                            'subjects' => 'all',
                            ));

                        foreach($teachers as $teacher){

                        if(TmbrBranch::where('teacher_id', $teacher->id)->where('status', 'Y')->count() > 0){

                        if(UserTask::where('teacher_id', $teacher->id)->where('gtask_id', $data->id)->count() == 0){
                                
                        $u_task = UserTask::Create(array(
                                    'deadline' => $data->deadline,
                                    'teacher_id'  => $teacher->id,
                                    'type' => 'G-Task',
                                    'gtask_id' => $data->id,
                                    
                        ));

                       }
                    }
                 
                }
            }


                elseif($value == 'All' && ($input['subject_id'][$key]) != 'All'){


                    InvGtask::Create(array(
                        'gtask_id' => $data->id,
                            'branches' => 'all',
                            'subject_id' => $input['subject_id'][$key],
                            ));


                    foreach($teachers as $teacher){

                    if(TmbrBranch::where('teacher_id', $teacher->id)->where('status', 'Y')->count() > 0 && TmbrSubject::where('teacher_id', $teacher->id)->where('subject_id', ($input['subject_id'][$key]) )->where('status', 'Y')->count() > 0){

                        if(UserTask::where('teacher_id', $teacher->id)->where('gtask_id', $data->id)->count() == 0){

                         $u_task = UserTask::Create(array(
                                    'deadline' => $data->deadline,
                                    'teacher_id'  => $teacher->id,
                                    'type' => 'G-Task',
                                    'gtask_id' => $data->id,
                        ));

                       }

                     }

                   }
                }

            }


            elseif($value != 'All' && ($input['subject_id'][$key]) != 'All'){


                InvGtask::Create(array(
                            'gtask_id' => $data->id,
                            'branch_id' => $value,
                            'subject_id' => $input['subject_id'][$key],
                            ));

                    foreach($teachers as $teacher){

                    if(TmbrBranch::where('teacher_id', $teacher->id)->where('branch_id', $value)->where('status', 'Y')->count() > 0 && TmbrSubject::where('teacher_id', $teacher->id)->where('subject_id', ($input['subject_id'][$key]) )->where('status', 'Y')->count() > 0){


                        if(UserTask::where('teacher_id', $teacher->id)->where('gtask_id', $data->id)->count() == 0){

                                $u_task = UserTask::Create(array(
                                                'deadline' => $data->deadline,
                                                'teacher_id'  => $teacher->id,
                                                'type' => 'G-Task',
                                                'gtask_id' => $data->id,
                                              
                                    ));

                            }
                    }
                  }

                }

                elseif($value != 'All' && ($input['subject_id'][$key]) == 'All'){


                    InvGtask::Create(array(
                        'gtask_id' => $data->id,
                            'branch_id' => $value,
                            'subjects' => 'all',
                            ));

                    foreach($teachers as $teacher){

                if(TmbrBranch::where('teacher_id', $teacher->id)->where('branch_id', $value)->where('status', 'Y')->count() > 0 && TmbrSubject::where('teacher_id', $teacher->id)->where('status', 'Y')->count() > 0){

                    if(UserTask::where('teacher_id', $teacher->id)->where('gtask_id', $data->id)->count() == 0){

                                        $u_task = UserTask::Create(array(
                                                                'deadline' => $data->deadline,
                                                                'teacher_id'  => $teacher->id,
                                                                'type' => 'G-Task',
                                                                'gtask_id' => $data->id,
                                                            
                                                    ));
                                        }
                            }

                    }
                }

        }
    }
    



       return Redirect(env('admin').'/g-task')->with('message','Task Updated Successfully.');


    }


    /*
    |------------------------------------------------------------------
    |   Extend Time Page
    |------------------------------------------------------------------
    */
    public function extend($id)
    {


        $g_task = GlobalTask::findOrFail($id);

        $data = [
            'id' => $id,
            'data' => $g_task,
            'link' => env('admin').'/g-task/'
        ];

        return View('admin.g_task.extend',$data);
    }


    /*
    |------------------------------------------------------------------
    |   Extend Time Submit
    |------------------------------------------------------------------
    */
    public function extendSubmit(Request $request, $id)
    {


        $data =  GlobalTask::findOrFail($id);

        $u_tasks = UserTask::where('gtask_id', $id)->get();

         if($data->validate($request->all(),"extend")){
            return Redirect(env('admin').'/g-task/'.$id.'/extend')->withErrors($data->validate($request->all(),"extend"))->withInput();
        }
       
        $data->end_date = $request->input('end_date');
        $data->save();


         foreach($u_tasks as $u_task){

            $u_task->deadline = $request->input('end_date');
            $u_task->save();

        }

       return Redirect(env('admin').'/g-task')->with('message','End Date Updated Successfully.');


    }



    /*
    |------------------------------------------------------------------
    |   Approve GlobalTask List
    |------------------------------------------------------------------
   

    public function ApproveTaskIndex()
    {

        $admin_id = Auth::guard('admin')->user()->id;


        $u_task =  UserTask::where('type','G-Task')->where('status','Pending')->get();
        $g_task =  GlobalTask::get();

        
        $data = [
            'data' => $u_task,
            'g_task' => $g_task,
            'teacher' => Teacher::get(),
            'student' => Student::get(),
            'link' => env('admin').'/g-task-requests/'
        ];

        return View('admin.g_task.a_index',$data);

    }

 */
    /*
    |------------------------------------------------------------------
    |   Index - Search
    |------------------------------------------------------------------
    

    public function ApproveSearch(Request $request){

    
    $admin_id = Auth::guard('admin')->user()->id;
    $u_task = UserTask::where('type','G-Task')->whereBetween('created_at', [$request->get('from'), $request->get('to')])->where('status','Pending')->get();
    $g_task =  GlobalTask::get();

        $data = [
           'data' => $u_task,
            'g_task' => $g_task,
            'teacher' => Teacher::get(),
            'student' => Student::get(),
            'link' => env('admin').'/g-task-requests/'
        ];


        return View('admin.g_task.search',$data);


    }


*/
    /*
    |------------------------------------------------------------------
    |   Approve Extend Request
    |------------------------------------------------------------------
    
    public function ExtendR($id){

        
        $data = UserTask::findOrFail($id);
        $data->req_no = $data->req_no + 1;

        $data->save();

       return Redirect(env('admin').'/g-extend-requests')->with('message','Request Approved Successfully.');

    }

*/
    /*
    |------------------------------------------------------------------
    |   Remove Extend Request
    |------------------------------------------------------------------
   
    public function erRemove($id){

        
        $data = UserTask::findOrFail($id);
        $data->has_request = 0;

        $data->save();

       return Redirect(env('admin').'/g-extend-requests')->with('message','Request Removed Successfully.');

    }

 */
}
