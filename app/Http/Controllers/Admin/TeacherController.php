<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Teacher;
use App\Branch;
use App\Subject;
use App\TmbrBranch;
use App\TmbrSubject;


class TeacherController extends Controller
{
    /*
    |------------------------------------------------------------------
    |   Teacher List Page
    |------------------------------------------------------------------
    */
    public function index(){
        $data = [
            'data' => Teacher::where('is_deleted','0')->get(),
            //'branch' => new Branch,
            'link' => env('admin').'/team-members/'
        ];

        return View('admin.users.team-members.index',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Teacher Add Page
    |------------------------------------------------------------------
    */
    public function show(){
        $data = [
            'data' => new Teacher,
           // 'branch' => Branch::where('is_deleted','0')->pluck('name','id'),
            'link' => env('admin').'/team-members/'
        ];

        return View('admin.users.team-members.add',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Teacher Data Store
    |------------------------------------------------------------------
    */
    public function store(Request $request){
        $data = new Teacher;

        if($data->validate($request->all(),"add")){
            return Redirect(env('admin').'/team-members/add')->withErrors($data->validate($request->all(),"add"))->withInput();
        }elseif($data->duplicateChk("add",$request)){
            return Redirect(env('admin').'/team-members/add')->with('error','Sorry! '.$data->duplicateChk("add",$request).' Already Exists')->withInput();
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

        return Redirect(env('admin').'/team-members')->with('message','New Team Member Added Successfully.');
    }

    /*
    |------------------------------------------------------------------
    |   Edit Teacher Page
    |------------------------------------------------------------------
    */
    public function edit($id){
        $data = [
            'id' => $id,
            'data' => Teacher::find($id),
          //  'branch' => Branch::pluck('name','id'),
            'link' => env('admin').'/team-members/'
        ];

        return View('admin.users.team-members.edit',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Teacher Data Update
    |------------------------------------------------------------------
    */
    public function update(Request $request,$id){
        $data = Teacher::find($id);

        if($data->validate($request->all(),"edit")){
            return Redirect(env('admin').'/team-members/'.$id.'/edit')->withErrors($data->validate($request->all(),"edit"))->withInput();
        }elseif($data->duplicateChk("edit",$request,$id)){
            return Redirect(env('admin').'/team-members/'.$id.'/edit')->with('error','Sorry! '.$data->duplicateChk("edit",$request,$id).' Already Exists')->withInput();
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

        return Redirect(env('admin').'/team-members')->with('message','Team Member Updated Successfully.');
    }

    /*
    |------------------------------------------------------------------
    |   Teacher Data Delete
    |------------------------------------------------------------------
    */
    public function destroy($id){
        $data = Teacher::find($id);
        $data->is_deleted = 1;
        $data->save();

        return Redirect(env('admin').'/team-members')->with('message','Team Member Deleted Successfully.');
    }

    /*
    |------------------------------------------------------------------
    |   Teacher Trash List Page
    |------------------------------------------------------------------
    */
    public function trash(){
        $data = [
            'data' => Teacher::where('is_deleted','1')->get(),
          //  'branch' => new Branch,
            'link' => env('admin').'/team-members/'
        ];

        return View('admin.users.team-members.trash',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Teacher Data Restore
    |------------------------------------------------------------------
    */
    public function restore($id){
        $data = Teacher::find($id);
        $data->is_deleted = 0;
        $data->save();

        return Redirect(env('admin').'/team-members/trash')->with('message','Team Member Restored Successfully.');
    }

    /*
    |------------------------------------------------------------------
    |   Teacher Data Delete Parmanently
    |------------------------------------------------------------------
    */
    public function destroyPermanent($id){
        $data = Teacher::find($id);
        $data->delete();

        return Redirect(env('admin').'/team-members/trash')->with('message','Team Member Deleted Successfully.');
    }
    


    /*
    |------------------------------------------------------------------
    |   Add Subject Page for Team Member
    |------------------------------------------------------------------
    */
    public function addSubject($id){
        $data = [
            'data' => TmbrSubject::where('teacher_id',$id)->get(),
            'subjects' => Subject::where('is_deleted','0')->get(),
            'teacher' => Teacher::find($id),
            'link' => env('admin').'/team-members/'
        ];

        return View('admin.users.team-members.subject',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Subject Store for Team Member
    |------------------------------------------------------------------
    */
    public function addSubjectStore(Request $request,$id){
        $data = new TmbrSubject;
        $teacher = Teacher::find($id);

        foreach($request->get('subject_id') as $subject=>$val){
        
          $status = $request->get('subject_id')[$subject];
            
            if( $status == 'N'){
                $status = 'N';
            }

            $tmbr_subjects_arr = [];
            $tmbr_subjects_arr['teacher_id'] = $id;
            $tmbr_subjects_arr['subject_id'] = $subject;

            $tmbr_subjects = TmbrSubject::firstOrCreate($tmbr_subjects_arr);

            $tmbr_subjects->status = $status;
            $tmbr_subjects->save();
        }

        return Redirect(env('admin').'/team-members')->with('message','Subject Added for '.$teacher->name.' Successfully.');
    }


    /*
    |------------------------------------------------------------------
    |   Add Branch Page for Team Member
    |------------------------------------------------------------------
    */
    public function addBranch($id){
        $data = [
            'data' => TmbrBranch::where('teacher_id',$id)->get(),
            'branch' => Branch::where('is_deleted','0')->get(),
            'teacher' => Teacher::find($id),
            'link' => env('admin').'/team-members/'
        ];

        return View('admin.users.team-members.add_branch',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Branch Store for Team Member
    |------------------------------------------------------------------
    */
    public function addBranchStore(Request $request,$id){
        $data = new TmbrBranch;
        $teacher = Teacher::find($id);

        foreach($request->get('branch_id') as $branch=>$val){
        
          $status = $request->get('branch_id')[$branch];
            
            if( $status == 'N'){
                $status = 'N';
            }

            $tmbr_branch_arr = [];
            $tmbr_branch_arr['teacher_id'] = $id;
            $tmbr_branch_arr['branch_id'] = $branch;

            $tmbr_branch = TmbrBranch::firstOrCreate($tmbr_branch_arr);

            $tmbr_branch->status = $status;
            $tmbr_branch->save();
        }

        return Redirect(env('admin').'/team-members')->with('message','Branch Assigned for '.$teacher->name.' Successfully.');
    }


}
