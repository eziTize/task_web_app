<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
use Auth;

class Admin extends Authenticatable
{
    protected $table = "admin";

	/*
	|----------------------------------------------------------------
	|	Validation rules
	|----------------------------------------------------------------
	*/
	public $rules = array(
        'name' 			=> 'required|max:255',
        'email' 		=> 'required|email|max:255',
		'password' 		=> 'required|min:6|max:20|regex:/[A-z]/|regex:/[0-9]/',
		'new_password' 	=> 'min:6|max:20|regex:/[A-z]/|regex:/[0-9]/|nullable',
		'phone'			=> 'numeric|nullable'
    );

    /*
	|----------------------------------------------------------------
	|	Validate data for add & update records
	|----------------------------------------------------------------
	*/
    public function validate($data){
		$validator = Validator::make($data,$this->rules);		
        
        if($validator->fails()){
			return $validator;
		}
	}
	
	/*
	|------------------------------------------------------------------
	|	Match with current password
	|------------------------------------------------------------------
	*/
	public function matchPassword($password){
	  	if(Auth::guard('admin')->attempt(['email' => Auth::guard('admin')->user()->email, 'password' => $password])){
			return false;
	  	}else{
		  	return true;
	  	}
	}
	
	/*
	|------------------------------------------------------------------
	|	If duplicate Email and/or Phone entered 
	|------------------------------------------------------------------
	*/
	public function duplicateChk($type,$request,$id=0){
		$email = strtolower($request->get('email'));
		$phone = $request->get('phone');

		if($type == "add"){
			if(Admin::where('email',$email)->exists()){
				return "Email";
			}elseif(($phone && Admin::where('phone',$phone)->exists())){
				return "Phone";
			}else{
				return false;
			}
		}else{
			if(Admin::where('id','!=',$id)->where('email',$email)->exists()){
				return "Email";
			}elseif(($phone && Admin::where('id','!=',$id)->where('phone',$phone)->exists())){
				return "Phone";
			}else{
				return false;
			}
		}
	}
}