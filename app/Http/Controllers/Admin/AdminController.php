<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;
use App\Admin;

class AdminController extends Controller
{
    
    /*
    |------------------------------------------------------------------
    |   Root Page
    |------------------------------------------------------------------
    */
    public function root(){
        if(Auth::guard('admin')->check()){
            return Redirect(env('admin').'/dashboard');
        }else{
            return Redirect(env('admin').'/login');
        }
    }

    /*
    |------------------------------------------------------------------
    |   Login Page
    |------------------------------------------------------------------
    */
    public function index(){
        if(Auth::guard('admin')->check()){
            return Redirect(env('admin').'/dashboard');
        }else{
            return View('admin.login');
        }
    }

    /*
    |------------------------------------------------------------------
    |   Login Check & Attempt
    |------------------------------------------------------------------
    */
    public function login(Request $request){
        $email = strtolower($request->input('email'));
        $password = $request->input('password');

        if(Auth::guard('admin')->attempt(['email' => $email,'password' => $password])){
            $user = Auth::guard('admin')->user();
            if($user->status){
                Auth::guard('admin')->logout();
                return Redirect(env('admin').'/login')->with('error','Your Account is Blocked');
            }elseif($user->is_deleted){
                Auth::guard('admin')->logout();
                return Redirect(env('admin').'/login')->with('error','Invalid Credentials');
            }else{
                return Redirect(env('admin').'/dashboard')->with('message','Welcome '.$user->name.'! You are logged in now');
            }
        }else{
            return Redirect(env('admin').'/login')->with('error','Invalid Credentials');
        }
    }

    /*
    |------------------------------------------------------------------
    |   Logout
    |------------------------------------------------------------------
    */
    public function logout(){
        Auth::guard('admin')->logout();
        return Redirect(env('admin').'/login')->with('message','Successfully logged out');
    }

    /*
    |------------------------------------------------------------------
    |   Dashboard Page
    |------------------------------------------------------------------
    */
    public function dashboard(){
        return View('admin.dashboard');
    }

    /*
    |------------------------------------------------------------------
    |   Account Settings Page
    |------------------------------------------------------------------
    */
    public function settings(){
        $data = [
            'data' => Auth::guard('admin')->user()
        ];
        
        return View('admin.settings',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Update Account Settings
    |------------------------------------------------------------------
    */
    public function update(Request $request){
        $user_id = Auth::guard('admin')->user()->id;
        $data = Admin::find($user_id);
		
		if($data->validate($request->all())){
			return Redirect(env('admin').'/settings')->withErrors($data->validate($request->all()))->withInput();
		}elseif($data->matchPassword($request->get('password'))){
			return Redirect(env('admin').'/settings')->with('error','Sorry! Your Current Password Not Match')->withInput();
		}elseif($data->duplicateChk("settings",$request,$user_id)){
            return Redirect(env('admin').'/settings')->with('error','Sorry! '.$data->duplicateChk("settings",$request,$user_id).' Already Exists')->withInput();
        }else{				
			$data->name = $request->get('name');
			$data->email = strtolower($request->get('email'));
			$data->phone = $request->get('phone');

			//if password changed
			if($request->get('new_password')){
				$data->password = bcrypt($request->get('new_password'));
			}	
			
			$data->save();
			
			return Redirect(env('admin').'/settings')->with('message', 'Account Setting Updated Successfully');
		}
    }
}