<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>search</title>
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen" />
    <link rel="stylesheet" type="text/css" href="style.css" media="all" />
	
	
		<script type="text/javascript" src="include/jquery-2.0.3.js"></script>
		<script type="text/javascript" src="include/DataTables-1.9.4/media/js/jquery.dataTables.js"></script>
		<script type="text/css" src="include/DataTables-1.9.4/media/css/jquery.dataTables.css"></script> 
		<script class="jsbin" src="http://datatables.net/download/build/jquery.dataTables.nightly.js"></script>
		<script type="text/javascript">
		$(document).ready( function () {
				$('div[class="container"] [class="table table-striped"]').dataTable();		
	} );
	
		</script>
		
	
	
</head>
<body>

<br />
<br />	
<a style="margin-left:5%" href="index.php">[new search]</a>
<br />
<br />
<br />
<br />	
<br />
<br />
<b style="margin-left:13%">filters:</b>
<br />
<br />

<?php
    mysql_connect("localhost", "root", "");
	mysql_select_db("sjsucsor_160g4fall2013");
    $result = mysql_query("SELECT * FROM course_data WHERE site LIKE '%$_GET[term]%' OR title LIKE '%$_GET[term]%' OR category LIKE '%$_GET[term]%'");
?>

<div class="container">
<table width="800" class="table table-striped">
<thead>
  <tr>
    <th>Name</th>
    <th></th>
	<th> Description </th>
    <th>Professor(s)</th>
	<th></th>
	<th>Start</th>
	<th>Length (Weeks)</th>
    <th>Site</th>
  </tr>
</thead>
<tbody>

<?php
	while($row = mysql_fetch_assoc($result))
	{
		$course_id = $row['id'];
		$title = $row['title'];
		$short_desc = $row['short_desc'];
		$long_desc = $row['long_desc'];
		$course_link = $row['course_link'];
		$video_link = $row['video_link'];
		$start_date = $row['start_date'];
		$course_length = $row['course_length'];
		$course_image = $row['course_image'];
		$category = $row['category'];
		$site = $row['site'];

		$detail_id = $course_id;
		$query_detail = "SELECT * FROM coursedetails WHERE course_id = '$detail_id'";
		$result_detail = mysql_query($query_detail);
		list($id, $profname, $profimage, $cid) = mysql_fetch_array($result_detail);
?>

  <tr height = '100'>
    <td width = '200' align='center'>
      <a href = '<?php echo $course_link ?>'>
<?php echo $title ?>
	  </a>
<?php if($video_link) { ?>
      <a href = '<?php echo $video_link ?>'>
      <img src = 'images/play_btn_icon.png' width ='15' height='15'>
	  </a>
<?php }; ?>
    </td>                    
    <td width="100" align='center'>
      <a href='<?php echo $course_link ?>'>
      <img src='<?php echo $course_image ?>' border='1' width='100' height='100'>
     </a>
    </td>
		                    
    <td align='center'>
<?php echo $short_desc ?>
    </td>

    <td width="100" align='center'><?php echo $profname ?></td>

    <td width="100" align='center'>
      <img src='<?php echo $profimage ?>' border='1' width='100' height='100'>
    </td>
		                        
    <td align='center'><?php echo $start_date ?></td>
		
    <?php if($course_length!=-1) { ?>
	<td width='50' align='center'><?php echo $course_length ?></td>
<?php } else { ?>
	<td width='50' align='center'>indefinite</td>                   
<?php } ?>
		               
	<td>
<?php echo $site ?>
	</td>
</tr>	
<?php } ?>
		           
</tbody>
</table>
	
</body>
</html>

