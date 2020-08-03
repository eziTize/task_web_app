<?php 

/*

|----------------------------------------------------------------------------

|@Class 		: IMS

|@Purpuse		: Define function's that are used globaly in project

|@Author		: Saharan Punit

|------------------------------------------------------------------------------

*/

namespace App\IMS;

use App\User;

use App\Activity;

use App\Branch;

use App\Student;

use Auth;

use Session;

use Redirect;



class IMS 

{

    /*

	|----------------------------------------------------------

	|This is for checking permission for access any page,

	|defined from where user created

	|----------------------------------------------------------

	*/

	public static function permission($type,$permission,$action)

	{

		$array = explode(",",Auth::guard($type)->user()->perm);

		

		if(in_array($permission,$array) || in_array("All",$array))

		{

		   $condition =  true;

		}	   

		else

		{

		   $condition = false;

		}

		

		if($action == "exit")

		{

			if($condition == false)

			{

				echo redirect('home')->with('error','Sorry ! You dont have permission to access this page.');

			}

		}

		else

		{

			return $condition;

		}

	}

	

	/*

	|-----------------------------------------------------------------------

	| Get status

	|-----------------------------------------------------------------------

	*/

	public static function status($status)

	{

		if($status == 0)

		{

			return "<span style='color:green'>Active</span>";

		}

		else

		{

			return "<span style='color:red'>Disabled</span>";

		}

	}

	

	/*

	|-----------------------------------------------------------------------

	| Get task status

	|-----------------------------------------------------------------------

	*/

	public static function task_status($task)

	{

		if($task->status == 1)

		{

			return "<span style='color:green'>Finish</span>";

		}

		elseif($task->finish_request == 1)

		{

			return "<span style='color:blue'>Request for Finish</span>";

		}

		else

		{

			return "<span style='color:blue'>Active</span>";

		}

	}

	

	/*

	|-----------------------------------------------------------------------

	| Get Add & Updated detail

	|-----------------------------------------------------------------------

	*/

	public static function addUpdate($addedBy,$updatedBy)

	{

		$getAddedBy 	= User::find($addedBy);

		$getupdatedBy 	= User::find($updatedBy);

		

		if(isset($getAddedBy->id))

		{

			$addedName = "Added By ".$getAddedBy->name;

		}

		else

		{

			$addedName = null;

		}

		

		if(isset($getupdatedBy->id))

		{

			$UpdatedName = " | Updated By ".$getupdatedBy->name;

		}

		else

		{

			$UpdatedName = null;

		}

		

		return $addedName.$UpdatedName;

	}

	

	/*

	|---------------------------------------------------------

	|Get currency prefix sign

	|---------------------------------------------------------

	*/

	public static function currency()

	{

		if(Auth::check())

		{

			$sign = Auth::user()->price_sign;

			

			if($sign)

			{

				return $sign;

			}

		}

		else

		{

			return "Rs.";

		}

	}

	

	/*

	|---------------------------------------------------------------

	| Set a global function for get logged in user branch id

	|---------------------------------------------------------------

	*/

	public static function bid()

	{

		if(Auth::check())

		{

			return Auth::user()->branch_id;

		}

		elseif(Session::has('student_id'))

		{

			return Session::get('student_id')->branch_id;

		}

		else

		{

			return 0;

		}

	}

	

	/*

	|---------------------------------------------------------------

	| Set a global function for get logged in branch

	|---------------------------------------------------------------

	*/

	public static function branch()

	{

		return Branch::find(Auth::user()->branch_id);

	}

	

	/*

	|---------------------------------------------------------------

	| Capture user activity

	|---------------------------------------------------------------

	*/

	public static function activity($notes)

	{

		$data = new Activity;

		$data->branch_id = IMS::bid();

		$data->user_id	 = Auth::user()->id;

		$data->notes	 = $notes;

		$data->save();

	}

	

	/*

	|----------------------------------------

	|Send SMS

	|----------------------------------------

	*/

	public static function sms($num,$msg)

	{

		$fullApi = Branch::find(IMS::bid())->sms_api;

		$api     = str_replace(['{msg}','{num}'],[$msg,$num],$fullApi);

		

		$url = $api;

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

		curl_setopt($ch, CURLOPT_URL,$url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$output = curl_exec ($ch);

		$info = curl_getinfo($ch);

		$http_result = $info ['http_code'];

		curl_close ($ch);

	}

	

	/*

	|-----------------------------------

	|Check for student panel logged in

	|------------------------------------

	*/

	public static function studentLogin()

	{

		if(Session::has('student_id') && Session::get('student_id') != '')

		{

			return true;

		}

		else

		{

			echo Redirect(env('student').'/login')->with('error','Please login for access this page.');

		}

	}



	

	

	/*

	|-----------------------------------

	|Calculate course finish date

	|------------------------------------

	*/

	public static function get_course_finish_date($course_join,$course_duration)

	{

		$course_complete = date('Y-m-d', strtotime($course_join.'+'.$course_duration.' months'));



		return $course_complete;

	}

	

	/*

	|-----------------------------------------------------------------------

	|Get Enquiry Status

	|-----------------------------------------------------------------------

	*/

	public static function enq_status($status)

	{

		if($status == 0)

		{

			return "<span style='color:red'>Not Assigned</span>";

		}

		if($status == 1)

		{

			return "<span style='color:grey'>Assigned</span>";

		}

		elseif($status == 2)

		{

			return "<span style='color:orange'>Called</span>";

		}

		elseif($status == 3)

		{

			return "<span style='color:green'>Walked In</span>";

		}

		else

		{

			return "<span style='color:blue'>Admitted</span>";

		}

	}



	/*

	|-----------------------------------------------------------------------

	|Generate Student Login ID

	|-----------------------------------------------------------------------

	*/

	public static function generate_student_login_id($id,$rand=""){

		$student = Student::find($id);



		$login_id = $id;



		$name_arr = explode(' ', $student->name);

  		foreach($name_arr as $n_arr){

     		$login_id .= strtoupper(substr($n_arr,0,1));

  		}

  

  		if($rand){

  			$login_id .= $rand;

  		}else{

  			$login_id .= rand(111,999);

  		}

  

  		return $login_id;

	}





	/*

	|-----------------------------------------------------------------------

	|Generate Student Login ID From Prefix

	|-----------------------------------------------------------------------

	*/

	public static function generate_student_login_id_prefix($id){

		$student = Student::find($id);



		$login_id = $id;



		$name_arr = explode(' ', $student->name);

  		foreach($name_arr as $n_arr){

     		$login_id .= strtoupper(substr($n_arr,0,1));

  		}

  

  		return $login_id;

	}

}