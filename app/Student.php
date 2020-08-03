<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
use Auth;

class Student extends Authenticatable
{
    protected $table = "student";

	/*
	|----------------------------------------------------------------
	|	Validation rules
	|----------------------------------------------------------------
	*/
	public $rules = array(
		//'branch_id'			=> 'required',
        'name' 		    	=> 'required|max:255',
        'gender'            => 'required',
        'email' 	    	=> 'required|email|max:255',
        'password'      	=> 'required|min:6|max:20|regex:/[A-z]/|regex:/[0-9]/',
		'confirm_password' 	=> 'required|same:password',
		'phone'				=> 'numeric|nullable'
    );

    public $erules = array(
		//'branch_id'			=> 'required',
        'name'      		=> 'required|max:255',
        'gender'            => 'required',
        'email'     		=> 'required|email|max:255',
        'password'      	=> 'min:6|max:20|regex:/[A-z]/|regex:/[0-9]/|nullable',
		'confirm_password' 	=> 'same:password',
		'phone'				=> 'numeric|nullable'
    );
	
	public $srules = array(
		'password' 		=> 'required|min:6|max:20|regex:/[A-z]/|regex:/[0-9]/',
		'new_password' 	=> 'min:6|max:20|regex:/[A-z]/|regex:/[0-9]/|nullable',
	);

    /*
	|----------------------------------------------------------------
	|	Validate data for add & update records
	|----------------------------------------------------------------
	*/
    public function validate($data,$type){
        if($type == "edit"){
            $ruleType = $this->erules;
        }elseif($type == "add"){
            $ruleType = $this->rules;
        }else{
			$ruleType = $this->srules;
		}

        $validator = Validator::make($data,$ruleType);

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
	  	if(Auth::guard('student')->attempt(['email' => Auth::guard('student')->user()->email, 'password' => $password])){
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
			if(Student::where('email',$email)->exists()){
				return "Email";
			}elseif(($phone && Student::where('phone',$phone)->exists())){
				return "Phone";
			}else{
				return false;
			}
		}else{
			if(Student::where('id','!=',$id)->where('email',$email)->exists()){
				return "Email";
			}elseif(($phone && Student::where('id','!=',$id)->where('phone',$phone)->exists())){
				return "Phone";
			}else{
				return false;
			}
		}
	}
}