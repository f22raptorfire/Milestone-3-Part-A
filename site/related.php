<?
	include("dbconnect.php");
	$result = mysql_query("SELECT `category` FROM course_data WHERE id=".$_GET['id']);
	
	$row = mysql_fetch_assoc($result);

	$category = $row['category'];
	
	$q = "SELECT * FROM `course_data` WHERE `category`='".$category."' AND NOT id=".$_GET['id']." LIMIT 0, 3";
	
	$result = mysql_query($q);
	

	$json = "{ \"urls\": [";
	
	
	while($row = mysql_fetch_assoc($result)) {
		$url = $row['course_link'];
		$json .= '"'. $url .'",';
	}
	
	$json = rtrim($json, ",");
	
	$json .= " ]} ";
	
	echo $json;	
?>
