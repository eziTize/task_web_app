<?php

namespace App\Http\Controllers\Admin;

use App\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class BranchController extends Controller
{
    /*
    |------------------------------------------------------------------
    |   Branch List Page
    |------------------------------------------------------------------
    */
    public function index(){
        $data = [
            'data' => Branch::where('is_deleted','0')->get(),
            'link' => env('admin').'/branch/'
        ];

        return View('admin.branch.index',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Branch Add Page
    |------------------------------------------------------------------
    */
    public function show(){
        $data = [
            'data' => new Branch,
            'link' => env('admin').'/branch/'
        ];

        return View('admin.branch.add',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Branch Data Store
    |------------------------------------------------------------------
    */
    public function store(Request $request){
        $data = new Branch;

        $data->name = $request->input('name');
        $data->address = $request->get('address');

        $data->save();

        return Redirect(env('admin').'/branch')->with('message','New Branch Added Successfully.');
    }

    /*
    |------------------------------------------------------------------
    |   Edit Branch Page
    |------------------------------------------------------------------
    */
    public function edit($id){
        $data = [
            'id' => $id,
            'data' => Branch::findOrFail($id),
            'link' => env('admin').'/branch/'
        ];

        return View('admin.branch.edit',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Branch Data Update
    |------------------------------------------------------------------
    */
    public function update(Request $request,$id){
        $data = Branch::findOrFail($id);
        
        $data->name = $request->get('name');
        $data->address = $request->get('address');

        $data->save();

        return Redirect(env('admin').'/branch')->with('message','Branch Updated Successfully.');
    }

    /*
    |------------------------------------------------------------------
    |   Branch Data Delete
    |------------------------------------------------------------------
    */
    public function destroy($id){
        $data = Branch::findOrFail($id);
        $data->is_deleted = 1;
        $data->save();

        return Redirect(env('admin').'/branch')->with('message','Branch Deleted Successfully.');
    }

    /*
    |------------------------------------------------------------------
    |   Branch Trash List Page
    |------------------------------------------------------------------
    */
    public function trash(){
        $data = [
            'data' => Branch::where('is_deleted','1')->get(),
            'link' => env('admin').'/branch/'
        ];

        return View('admin.branch.trash',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Branch Data Restore
    |------------------------------------------------------------------
    */
    public function restore($id){
        $data = Branch::findOrFail($id);
        $data->is_deleted = 0;
        $data->save();

        return Redirect(env('admin').'/branch/trash')->with('message','Branch Restored Successfully.');
    }

    /*
    |------------------------------------------------------------------
    |   Branch Data Delete Parmanently
    |------------------------------------------------------------------
    */
    public function destroyPermanent($id){
        $data = Branch::findOrFail($id);
        $data->delete();

        return Redirect(env('admin').'/branch/trash')->with('message','Branch Deleted Successfully.');
    }
}
