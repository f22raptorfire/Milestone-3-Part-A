<!-- Featured course slider -->
<?php include("dbconnect.php");?>
	<script type="text/javascript" src="include/jquery-2.0.3.js"></script>
	<script src="js/jquery.faded.js" type="text/javascript" charset="utf-8"></script>

	<div id="faded">
	  	<ul class="rap">
		   <li line-height:'16px'>
		    <?php
		   	   $featured_query = "SELECT * FROM course_data WHERE id = '3'";
		       $featured_result = mysql_query($featured_query);
		       list($fid, $ftitle, $fshort, $flong, $f_crs_link, $f_vid_link, $f_start_date, $f_course_length, $f_course_image, $f_category, $f_site) = mysql_fetch_array($featured_result);
			   
				echo "<img width='100' height='100' src='$f_course_image'>";
				echo "<br />";			   
		   		echo "<h1>$f_site : $ftitle</h1>"; 
				echo "<h4>$f_category</h3>";
				echo "<p> Description: $fshort</p>";
				echo "start date: $f_start_date";
				echo "<div style='margin-left:90%;'><a href='$f_crs_link'>";
			    echo "<h5>more info</h5>";
				echo "</a></div>";
		   	?>
		   	</li>
			   <li line-height:'16px'>
		    <?php
		   	   $featured_query = "SELECT * FROM course_data WHERE id = '4'";
		       $featured_result = mysql_query($featured_query);
		       list($fid, $ftitle, $fshort, $flong, $f_crs_link, $f_vid_link, $f_start_date, $f_course_length, $f_course_image, $f_category, $f_site) = mysql_fetch_array($featured_result);
			   
				echo "<img width='100' height='100' src='$f_course_image'>";
				echo "<br />";			   
		   		echo "<h1>$f_site : $ftitle</h1>"; 
				echo "<h4>$f_category</h3>";
				echo "<p> Description: $fshort</p>";
				echo "start date: $f_start_date";
				echo "<div style='margin-left:90%;'><a href='$f_crs_link'>";
			    echo "<h5>more info</h5>";
				echo "</a></div>";
		   	?>
		   	</li>
			   <li line-height:'16px'>
		    <?php
		   	   $featured_query = "SELECT * FROM course_data WHERE id = '5'";
		       $featured_result = mysql_query($featured_query);
		       list($fid, $ftitle, $fshort, $flong, $f_crs_link, $f_vid_link, $f_start_date, $f_course_length, $f_course_image, $f_category, $f_site) = mysql_fetch_array($featured_result);
			   
				echo "<img width='100' height='100' src='$f_course_image'>";
				echo "<br />";			   
		   		echo "<h1>$f_site : $ftitle</h1>"; 
				echo "<h4>$f_category</h3>";
				echo "<p> Description: $fshort</p>";
				echo "start date: $f_start_date";
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