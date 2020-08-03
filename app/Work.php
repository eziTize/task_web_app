<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Input;
use Validator;


class Work extends Authenticatable

{
	protected $table = "works";

	protected $fillable = ['teacher_id', 'name', 'desc', 'start_date', 'started_at', 'ended_at'];




	/*
	|----------------------------------------------------------------
	|	Validation rules
	|----------------------------------------------------------------
	*/
	public $rules = array(

		'name'		=> 'required',
        'desc'		=> 'required',
        'started_at' => 'required',
		'ended_at'   => 'required',
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


	

    

    public static function deleteLog($id){

        $work = Work::findOrFail($id);

        $work->delete();
    }

}