<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

class loggedInUser 
{
	public $email = NULL;
	public $hash_pw = NULL;
	public $user_id = NULL;
	
	//MyCousre functions
	public function addCourse($course_id)
	{
		/*
		We can assume that the course being added is not a duplicate
		*/
		if(!self::isUserInCourseDB())
			self::addUserToCourseDB();

		$query = "SELECT * FROM user_courses WHERE user_id = '$this->user_id'";
		$result = mysql_query($query);
		list($user_id_db, $courses) = mysql_fetch_array($result);

		if(empty($courses))
			$courses = $course_id+"";
		else
			$courses = $courses."|".$course_id;

		//UPDATE Database
		$query = "UPDATE user_courses SET courses='$courses' WHERE user_id='$user_id_db'";
		$result = mysql_query($query);

		echo "Course added!";

		//Ad course to user db
	}

	public function removeCourse($course_id)
	{
		if(!self::isUserInCourseDB())
			self::addUserToCourseDB();

		$query = "SELECT * FROM user_courses WHERE user_id = '$this->user_id'";
		$result = mysql_query($query);
		list($user_id_db, $courses) = mysql_fetch_array($result);

		$new_course_set = "";
		$course_array = explode("|",$courses);

		foreach($course_array as $old_course)
		{
			if(strcmp($old_course,$course_id)!=0)
			{
				if(empty($new_course_set))
					$new_course_set = $old_course."";
				else
					$new_course_set = $new_course_set."|".$old_course;
			}
		}

		//UPDATE Database
		$query = "UPDATE user_courses SET courses='$new_course_set' WHERE user_id='$user_id_db'";
		$result = mysql_query($query);

		echo "Course added!";

		//Remove course from db
	}

	public function isCourseAdded($course_id)
	{
		if(!self::isUserInCourseDB())
			self::addUserToCourseDB();

		$query = "SELECT * FROM user_courses WHERE user_id = '$this->user_id'";
		$result = mysql_query($query);
		list($user_id_db, $courses) = mysql_fetch_array($result);
		
		$courses_array = explode("|",$courses);
		
		$isAdded = in_array($course_id, $courses_array);

		return $isAdded;
	}

	public function getAllCourses()
	{
		if(!self::isUserInCourseDB())
			self::addUserToCourseDB();

		$query = "SELECT * FROM user_courses WHERE user_id = '$this->user_id'";
		$result = mysql_query($query);
		list($user_id_db, $courses) = mysql_fetch_array($result);

		return $courses;
	}

	private function isUserInCourseDB()
	{
		$query = "SELECT * FROM user_courses WHERE user_id = '$this->user_id'";
		$result = mysql_query($query);
		$num = mysql_num_rows($result);

		if($num == 0)
			return false;

		return true;
	}

	private function addUserToCourseDB()
	{
		$query = "INSERT INTO user_courses(user_id, courses) VALUES ('$this->user_id','')";
		mysql_query($query);

	}

	//Simple function to update the last sign in of a user
	public function updateLastSignIn()
	{
		global $mysqli,$db_table_prefix;
		$time = time();
		$stmt = $mysqli->prepare("UPDATE ".$db_table_prefix."users
			SET
			last_sign_in_stamp = ?
			WHERE
			id = ?");
		$stmt->bind_param("ii", $time, $this->user_id);
		$stmt->execute();
		$stmt->close();	
	}
	
	//Return the timestamp when the user registered
	public function signupTimeStamp()
	{
		global $mysqli,$db_table_prefix;
		
		$stmt = $mysqli->prepare("SELECT sign_up_stamp
			FROM ".$db_table_prefix."users
			WHERE id = ?");
		$stmt->bind_param("i", $this->user_id);
		$stmt->execute();
		$stmt->bind_result($timestamp);
		$stmt->fetch();
		$stmt->close();
		return ($timestamp);
	}
	
	//Update a users password
	public function updatePassword($pass)
	{
		global $mysqli,$db_table_prefix;
		$secure_pass = generateHash($pass);
		$this->hash_pw = $secure_pass;
		$stmt = $mysqli->prepare("UPDATE ".$db_table_prefix."users
			SET
			password = ? 
			WHERE
			id = ?");
		$stmt->bind_param("si", $secure_pass, $this->user_id);
		$stmt->execute();
		$stmt->close();	
	}
	
	//Update a users email
	public function updateEmail($email)
	{
		global $mysqli,$db_table_prefix;
		$this->email = $email;
		$stmt = $mysqli->prepare("UPDATE ".$db_table_prefix."users
			SET 
			email = ?
			WHERE
			id = ?");
		$stmt->bind_param("si", $email, $this->user_id);
		$stmt->execute();
		$stmt->close();	
	}
	
	//Is a user has a permission
	public function checkPermission($permission)
	{
		global $mysqli,$db_table_prefix,$master_account;
		
		//Grant access if master user
		
		$stmt = $mysqli->prepare("SELECT id 
			FROM ".$db_table_prefix."user_permission_matches
			WHERE user_id = ?
			AND permission_id = ?
			LIMIT 1
			");
		$access = 0;
		foreach($permission as $check){
			if ($access == 0){
				$stmt->bind_param("ii", $this->user_id, $check);
				$stmt->execute();
				$stmt->store_result();
				if ($stmt->num_rows > 0){
					$access = 1;
				}
			}
		}
		if ($access == 1)
		{
			return true;
		}
		if ($this->user_id == $master_account){
			return true;	
		}
		else
		{
			return false;	
		}
		$stmt->close();
	}
	
	//Logout
	public function userLogOut()
	{
		destroySession("userCakeUser");
	}	
}

?>