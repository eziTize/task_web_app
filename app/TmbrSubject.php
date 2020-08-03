<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class TmbrSubject extends Model
{
    protected $table = "tmbr_subjects";
	
	protected $guarded = ['id'];


	/*
	|----------------------------------------------------------------
	|	Single Subject View
	|----------------------------------------------------------------
	*/
	public static function subjectView($teacher_id,$subject_id){
		$subject = DB::table('tmbr_subjects')
					->join('subjects', 'subjects.id', '=','tmbr_subjects.subject_id')
					->select('tmbr_subjects.*', 'subjects.name')
					->where('tmbr_subjects.teacher_id', $teacher_id)
					->where('tmbr_subjects.subject_id', $subject_id)
					//->where('branch_course.fee', '>' , '0')
					->where('tmbr_subjects.status', 'Y')
					->first();
					
		return $subject;
    }

}
