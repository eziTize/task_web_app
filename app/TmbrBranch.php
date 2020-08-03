<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


class TmbrBranch extends Model
{
    protected $table = "tmbr_branch";
	
	protected $guarded = ['id'];


	/*
	|----------------------------------------------------------------
	|	Single Branch View
	|----------------------------------------------------------------
	*/
	public static function branchView($teacher_id,$branch_id){
		$branch = DB::table('tmbr_branch')
					->join('branches', 'branches.id', '=','tmbr_branch.branch_id')
					->select('tmbr_branch.*', 'branches.name')
					->where('tmbr_branch.teacher_id', $teacher_id)
					->where('tmbr_branch.branch_id', $branch_id)
					//->where('branch_course.fee', '>' , '0')
					->where('tmbr_branch.status', 'Y')
					->first();
					
		return $branch;
    }
}