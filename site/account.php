<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/
include "header.php";

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
?>

<link href="css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link rel="stylesheet" type="text/css" href="style.css" media="all" />

<script>
	function removeCourse(course_id)
	{
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
		    	location.reload();
		    }
		}
		xmlhttp.open("GET","process.php?course_id="+course_id+"&func=rc",true);
		xmlhttp.send();
	}
</script>

<?
if(isUserLoggedIn())
{
	echo "
	</div>
		<div id='main'>
			Hello $loggedInUser->displayname.<br>
			You registered this account on " . date("M d, Y", $loggedInUser->signupTimeStamp()) . "<br>
		</div>";

	//Get My courses
	echo"
	<div>
		<br>
		<br>
		<h1>MyCourses Calendar</h1>
		<br>
		<table>
			<th>
				Start Date
			</th>
			<th>
				Weeks
			</th>
			<th>
				Title
			</th>";

		$courses = $loggedInUser->getAllCourses();
		$course_array = explode("|",$courses);		

		foreach($course_array as $course_id)
		{
			//Load course_data from database
			$query = "SELECT * FROM course_data WHERE id='$course_id'";
			$result = mysql_query($query);
			while($row = mysql_fetch_assoc($result))
			{
				$title = $row['title'];
				$link = $row['course_link'];
				$start_date = $row['start_date'];
				$length = $row['course_length'];

				echo"
				<tr>
					<td>";
						if(strtotime($start_date) != false && strtotime($start_date) < time())
							echo "Course has started";
						else
							echo $start_date;
				echo"
					</td>
					<td>";
						if($length==-1 || $length ==0)
							echo "Self Paced";
						else
							echo $length;
				echo"
					</td>
					<td>
						<a href='$link'>$title</a>
					</td>
					<td>
						<button type='button' onclick='removeCourse($course_id)'>Remove</button>
					</td>	
				</tr>";			
			}
		}
	echo"
		</table>
	<div>
	";

	echo "<div id='bottom'></div>
		</div>
		</body>
		</html>";
}
else
{
	echo "
		</div>
			You are not logged in. Please use the link in the top left to log in.
		<div>
	";
}



?>
