<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;


class UserTask extends Model
{
	protected $table = "user_tasks";
	protected $fillable = ['deadline', 'student_id', 'teacher_id', 'type', 'task_id', 'gtask_id'];


	/*
	|----------------------------------------------------------------
	|	Validation rules
	|----------------------------------------------------------------
	*/
	public $rules = array(

        'ex_date'		=> 'required|date|after_or_equal:today'
    );


    /*
	|----------------------------------------------------------------
	|	Validate data for add & extend & update records
	|----------------------------------------------------------------
	*/
    public function validate($data,$type){
      
            $ruleType = $this->rules;
 
        $validator = Validator::make($data,$ruleType);

        if($validator->fails()){
            return $validator;
        }
	}

}