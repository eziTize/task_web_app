<?php

namespace App\Http\Controllers\Admin;

use App\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SubjectController extends Controller
{
   
    /*
    |------------------------------------------------------------------
    |   Subject List Page
    |------------------------------------------------------------------
    */
    public function index(){
        $data = [
            'data' => Subject::where('is_deleted','0')->get(),
            'link' => env('admin').'/subjects/'
        ];

        return View('admin.subjects.index',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Subject Add Page
    |------------------------------------------------------------------
    */
    public function show(){
        $data = [
            'data' => new Subject,
            'link' => env('admin').'/subjects/'
        ];

        return View('admin.subjects.add',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Subject Data Store
    |------------------------------------------------------------------
    */
    public function store(Request $request){
        $data = new Subject;

        $data->name = $request->input('name');
        $data->save();

        return Redirect(env('admin').'/subjects')->with('message','New Subject Added Successfully.');
    }

    /*
    |------------------------------------------------------------------
    |   Edit Subject Page
    |------------------------------------------------------------------
    */
    public function edit($id){
        $data = [
            'id' => $id,
            'data' => Subject::findOrFail($id),
            'link' => env('admin').'/subjects/'
        ];

        return View('admin.subjects.edit',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Subject Data Update
    |------------------------------------------------------------------
    */
    public function update(Request $request,$id){
        $data = Subject::findOrFail($id);
        
        $data->name = $request->get('name');
        $data->save();

        return Redirect(env('admin').'/subjects')->with('message','Subject Updated Successfully.');
    }

    /*
    |------------------------------------------------------------------
    |   Subject Data Delete
    |------------------------------------------------------------------
    */
    public function destroy($id){
        $data = Subject::findOrFail($id);
        $data->is_deleted = 1;
        $data->save();

        return Redirect(env('admin').'/subjects')->with('message','Subject Deleted Successfully.');
    }

    /*
    |------------------------------------------------------------------
    |   Subject Trash List Page
    |------------------------------------------------------------------
    */
    public function trash(){
        $data = [
            'data' => Subject::where('is_deleted','1')->get(),
            'link' => env('admin').'/subjects/'
        ];

        return View('admin.subjects.trash',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Subject Data Restore
    |------------------------------------------------------------------
    */
    public function restore($id){
        $data = Subject::findOrFail($id);
        $data->is_deleted = 0;
        $data->save();

        return Redirect(env('admin').'/subjects/trash')->with('message','Subject Restored Successfully.');
    }

    /*
    |------------------------------------------------------------------
    |   Subject Data Delete Parmanently
    |------------------------------------------------------------------
    */
    public function destroyPermanent($id){
        $data = Subject::findOrFail($id);
        $data->delete();

        return Redirect(env('admin').'/subjects/trash')->with('message','Subject Deleted Successfully.');
    }
}
