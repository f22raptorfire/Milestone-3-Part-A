<!DOCTYPE html>
<html lang="en-US">
<head>
	<?php
		/*
		UserCake Version: 2.0.2
		http://usercake.com
		*/
		require_once("models/config.php");
		if (!securePage($_SERVER['PHP_SELF'])){die();}
	?>

	<meta http-equiv="content-type" content="text/html; charset=UTF-8">

	<title>User Profile</title>
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen" />
	<link rel="stylesheet" type="text/css" href="style.css" media="all" />

	<script type="text/javascript">
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
</head>

<body>
	<?php include "header.php"; ?>
	<?php
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
				<thead>
					<tr>
						<th>Start Date</th>
						<th>Weeks</th>
						<th>Title</th>
					</tr>
				</thead>
				<tbody>";

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
				</tbody>
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
</body>
</html>