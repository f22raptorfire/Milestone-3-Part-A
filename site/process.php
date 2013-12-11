<?
	include("dbconnect.php");
	require_once("models/config.php"); 

	if(isUserLoggedIn())
	{
		$func = $_GET["func"];

		if(strcmp($func, "ac")==0)
		{
			//Add course
			$course_id = intval($_GET["course_id"]);
			if(!$loggedInUser->isCourseAdded($course_id))
			{
				$loggedInUser->addCourse($course_id);
				exit(0);
			}
			else
			{
				echo "Course already added.";
				exit(0);
			}
			
		}

		if(strcmp($func,"rc")==0)
		{
			$course_id = intval($_GET["course_id"]);
			$loggedInUser->removeCourse($course_id);
			exit(0);
		}

		if(strcmp($func, "gc")==0)
		{
			return $loggedInUser->getAllCourses();
			exit(0);
		}
		//Function not found
		exit(1);
	}
	else
	{
		//Attempt to access page without being logged in
		exit(1);
	}
?>