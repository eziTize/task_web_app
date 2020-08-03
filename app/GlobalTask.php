<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class GlobalTask extends Model
{
	protected $table = "global_tasks";

	/*
	|----------------------------------------------------------------
	|	Validation rules
	|----------------------------------------------------------------
	*/
	public $rules = array(

		'task_name'		=> 'required',
        'task_desc'		=> 'required',
        'start_date'	=> 'required|date|after_or_equal:today',
        'end_date'		=> 'required|date|after_or_equal:start_date'
    );


    public $erules = array(
        'task_name'		=> 'required',
        'task_desc'		=> 'required',
    );



     public $exrules = array(
        'end_date'		=> 'required|date|after:today'
    );


      /*
	|----------------------------------------------------------------
	|	Validate data for add & extend & update records
	|----------------------------------------------------------------
	*/
    public function validate($data,$type){
        if($type == "edit"){
            $ruleType = $this->erules;
        }elseif($type == "extend"){
            $ruleType = $this->exrules;
        }else{
            $ruleType = $this->rules;
        }

        $validator = Validator::make($data,$ruleType);

        if($validator->fails()){
            return $validator;
        }
	}

}
