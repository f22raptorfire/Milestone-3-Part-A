<!-- Featured course slider -->
<?php include("dbconnect.php");?>
	<script type="text/javascript" src="include/jquery-2.0.3.js"></script>
	<script src="js/jquery.faded.js" type="text/javascript" charset="utf-8"></script>

	<?
		//Get number of courses
		$course_count_query = "SELECT COUNT(*) FROM course_data";
		$course_count_result = mysql_query($course_count_query);

		//$query = "SELECT * FROM course_data"
		//$result = mysql_query($query)
		//$course_count = mysql_num_rows($result);
		
		$featured_course1 = rand(3,1002);
		$featured_course2 = rand(3,1002);
		$featured_course3 = rand(3,1002);
	?>

	<div id="faded">
	  	<ul class="rap">
		   <li line-height:'20px'>
		    <?php
		   	   $featured_query = "SELECT * FROM course_data WHERE id = '$featured_course1'";
		       $featured_result = mysql_query($featured_query);
		       list($fid, $ftitle, $fshort, $flong, $f_crs_link, $f_vid_link, $f_start_date, $f_course_length, $f_course_image, $f_category, $f_site) = mysql_fetch_array($featured_result);
			   
			   	echo "<div style='height:245px;width:830px;overflow:auto;'>";
				echo "<img width='100' height='100' src='$f_course_image'>";
				echo "<br />";			   
		   		echo "<h1>$f_site : $ftitle</h1>"; 
				echo "<h4>$f_category</h3>";
				echo "<p> Description: $fshort</p>";
				echo "</div>";

				echo "<div style='margin-left:90%;'><a href='$f_crs_link'>";
			    echo "<h5>more info</h5>";
				echo "</a></div>";
		   	?>
		   	</li>
		    <li line-height:'20px'>
		    <?php
		   	   $featured_query = "SELECT * FROM course_data WHERE id = '$featured_course2'";
		       $featured_result = mysql_query($featured_query);
		       list($fid, $ftitle, $fshort, $flong, $f_crs_link, $f_vid_link, $f_start_date, $f_course_length, $f_course_image, $f_category, $f_site) = mysql_fetch_array($featured_result);
			   
			    echo "<div style='height:245px;width:830px;overflow:auto;'>";
				echo "<img width='100' height='100' src='$f_course_image'>";
				echo "<br />";			   
		   		echo "<h1>$f_site : $ftitle</h1>"; 
				echo "<h4>$f_category</h3>";
				echo "<p> Description: $fshort</p>";
				echo "</div>";

				echo "<div style='margin-left:90%;'><a href='$f_crs_link'>";
				echo "<h5>more info</h5>";
				echo "</a></div>";
		   	?>
		   	</li>
		   <li line-height:'20px'>
		    <?php
		   	   $featured_query = "SELECT * FROM course_data WHERE id = '$featured_course3'";
		       $featured_result = mysql_query($featured_query);
		       list($fid, $ftitle, $fshort, $flong, $f_crs_link, $f_vid_link, $f_start_date, $f_course_length, $f_course_image, $f_category, $f_site) = mysql_fetch_array($featured_result);
			   
			    echo "<div style='height:245px;width:830px;overflow:auto;'>";
				echo "<img width='100' height='100' src='$f_course_image'>";
				echo "<br />";			   
		   		echo "<h1>$f_site : $ftitle</h1>"; 
				echo "<h4>$f_category</h3>";
				echo "<p> Description: $fshort</p>";
				echo "</div>";

				echo "<div style='margin-left:90%;'><a href='$f_crs_link'>";
			    echo "<h5>more info</h5>";
				echo "</a></div>";
		   	?>
		   	</li>
	  	</ul>
	</div>
	<script type="text/javascript" charset="utf-8">
		$(function(){
			$("#faded").faded({
				//speed: 10000,
				crossfade: false,
				bigtarget: false,
				sequentialloading: false,
				loadingimg: "images/loading.gif",
				autoplay: false,
				random: false,
				autopagination:true,
				autoheight: false
			});
		});
	</script>
	<!-- End featured course slider -->