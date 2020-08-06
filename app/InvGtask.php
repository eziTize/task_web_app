<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvGtask extends Model
{
    protected $table = "inv_gtasks";

	protected $fillable = ['branch_id', 'branches', 'subject_id', 'subjects', 'gtask_id'];

}
