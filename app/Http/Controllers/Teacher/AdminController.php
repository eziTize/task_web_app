<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;
use App\Teacher;
use App\Task;

class AdminController extends Controller
{
    
    /*
    |------------------------------------------------------------------
    |   Root Page
    |------------------------------------------------------------------
    */
    public function root(){
        if(Auth::guard('teacher')->check()){
            return Redirect(env('teacher').'/dashboard');
        }else{
            return Redirect(env('teacher').'/login');
        }
    }

    /*
    |------------------------------------------------------------------
    |   Login Page
    |------------------------------------------------------------------
    */
    public function index(){
        if(Auth::guard('teacher')->check()){
            return Redirect(env('teacher').'/dashboard');
        }else{
            return View('teacher.login');
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

        if(Auth::guard('teacher')->attempt(['email' => $email,'password' => $password])){
            $user = Auth::guard('teacher')->user();
            if($user->status){
                Auth::guard('teacher')->logout();
                return Redirect(env('teacher').'/login')->with('error','Your Account is Blocked');
            }elseif($user->is_deleted){
                Auth::guard('teacher')->logout();
                return Redirect(env('teacher').'/login')->with('error','Invalid Credentials');
            }else{
                return Redirect(env('teacher').'/dashboard')->with('message','Welcome '.$user->name.'! You are logged in now');
            }
        }else{
            return Redirect(env('teacher').'/login')->with('error','Invalid Credentials');
        }
    }

    /*
    |------------------------------------------------------------------
    |   Login with ID
    |------------------------------------------------------------------
    */
    public function loginWithID($id){
        if(Auth::guard('teacher')->loginUsingId($id)){
            return Redirect(env('teacher').'/dashboard')->with('message','Welcome '.Auth::guard('teacher')->user()->name.'! You are logged in now');	
		}else{
			return Redirect(env('teacher').'/login')->with('error', 'Something went wrong.');
		}
    }

    /*
    |------------------------------------------------------------------
    |   Logout
    |------------------------------------------------------------------
    */
    public function logout(){
        Auth::guard('teacher')->logout();
        return Redirect(env('teacher').'/login')->with('message','Successfully logged out');
    }

    /*
    |------------------------------------------------------------------
    |   Dashboard Page
    |------------------------------------------------------------------
    */
    public function dashboard(){

        return View('teacher.dashboard');
    }

    /*
    |------------------------------------------------------------------
    |   Account Settings Page
    |------------------------------------------------------------------
    */
    public function settings(){
        $data = [
            'data' => Auth::guard('teacher')->user()
        ];
        
        return View('teacher.settings',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Update Account Settings
    |------------------------------------------------------------------
    */
    public function update(Request $request){
        $user_id = Auth::guard('teacher')->user()->id;
        $data = Teacher::find($user_id);
		
		if($data->validate($request->all(),"settings")){
			return Redirect(env('teacher').'/settings')->withErrors($data->validate($request->all(),"settings"))->withInput();
		}elseif($data->matchPassword($request->get('password'))){
			return Redirect(env('teacher').'/settings')->with('error','Sorry! Your Current Password Not Match')->withInput();
		}elseif($data->duplicateChk("settings",$request,$user_id)){
            return Redirect(env('teacher').'/settings')->with('error','Sorry! '.$data->duplicateChk("settings",$request,$user_id).' Already Exists')->withInput();
        }else{				

			//if password changed
			if($request->get('new_password')){
				$data->password = bcrypt($request->get('new_password'));
			}	
			
			$data->save();
			
			return Redirect(env('teacher').'/settings')->with('message', 'Account Setting Updated Successfully');
		}
    }
}