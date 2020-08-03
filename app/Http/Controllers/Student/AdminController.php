<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;
use App\Student;
use App\Task;

class AdminController extends Controller
{
    
    /*
    |------------------------------------------------------------------
    |   Root Page
    |------------------------------------------------------------------
    */
    public function root(){
        if(Auth::guard('student')->check()){
            return Redirect(env('student').'/dashboard');
        }else{
            return Redirect(env('student').'/login');
        }
    }

    /*
    |------------------------------------------------------------------
    |   Login Page
    |------------------------------------------------------------------
    */
    public function index(){
        if(Auth::guard('student')->check()){
            return Redirect(env('student').'/dashboard');
        }else{
            return View('student.login');
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

        if(Auth::guard('student')->attempt(['email' => $email,'password' => $password])){
            $user = Auth::guard('student')->user();
            if($user->status){
                Auth::guard('student')->logout();
                return Redirect(env('student').'/login')->with('error','Your Account is Blocked');
            }elseif($user->is_deleted){
                Auth::guard('student')->logout();
                return Redirect(env('student').'/login')->with('error','Invalid Credentials');
            }else{
                return Redirect(env('student').'/dashboard')->with('message','Welcome '.$user->name.'! You are logged in now');
            }
        }else{
            return Redirect(env('student').'/login')->with('error','Invalid Credentials');
        }
    }

    /*
    |------------------------------------------------------------------
    |   Login with ID
    |------------------------------------------------------------------
    */
    public function loginWithID($id){
        if(Auth::guard('student')->loginUsingId($id)){
            return Redirect(env('student').'/dashboard')->with('message','Welcome '.Auth::guard('student')->user()->name.'! You are logged in now');	
		}else{
			return Redirect(env('student').'/login')->with('error', 'Something went wrong.');
		}
    }

    /*
    |------------------------------------------------------------------
    |   Logout
    |------------------------------------------------------------------
    */
    public function logout(){
        Auth::guard('student')->logout();
        return Redirect(env('student').'/login')->with('message','Successfully logged out');
    }

    /*
    |------------------------------------------------------------------
    |   Dashboard Page
    |------------------------------------------------------------------
    */
    public function dashboard(){
    

        return View('student.dashboard');
    }

    /*
    |------------------------------------------------------------------
    |   Account Settings Page
    |------------------------------------------------------------------
    */
    public function settings(){
        $data = [
            'data' => Auth::guard('student')->user()
        ];
        
        return View('student.settings',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Update Account Settings
    |------------------------------------------------------------------
    */
    public function update(Request $request){
        $user_id = Auth::guard('student')->user()->id;
        $data = Student::find($user_id);
		
		if($data->validate($request->all(),"settings")){
			return Redirect(env('student').'/settings')->withErrors($data->validate($request->all(),"settings"))->withInput();
		}elseif($data->matchPassword($request->get('password'))){
			return Redirect(env('student').'/settings')->with('error','Sorry! Your Current Password Not Match')->withInput();
		}elseif($data->duplicateChk("settings",$request,$user_id)){
            return Redirect(env('student').'/settings')->with('error','Sorry! '.$data->duplicateChk("settings",$request,$user_id).' Already Exists')->withInput();
        }else{				

			//if password changed
			if($request->get('new_password')){
				$data->password = bcrypt($request->get('new_password'));
			}	
			
			$data->save();
			
			return Redirect(env('student').'/settings')->with('message', 'Account Setting Updated Successfully');
		}
    }
}