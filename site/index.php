<html>
<head>
	<title>home</title>

	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen" />
    <link rel="stylesheet" type="text/css" href="style.css" media="all" />

	<style type="text/css"> 
#navcontainer ul
{
margin: 0;
padding: 0;
list-style-type: none;
text-align: center;
}

#navcontainer ul li { display: inline; }

#navcontainer ul li a
{
text-decoration: none;
padding: .2em 1em;
}
	a { font-size: 10px;}

	
	body {
		margin-left:auto;
		margin-right:auto;
		text-align: center;
	}
	
	img {padding: 5px;}
	
	p {
		padding: 5px;
		text-align: left;
	}
	
	</style>
	
	
</head>
<body>

<?php include "slider.php";?>



	<br />
	<br />
	
	
	<form action="search.php" method="GET">
	 <b>Search: </b> <input type="text" name="term" size="50">
	<input type="submit" value="Search">
	</form>
	
	
	<b>Categories</b>
	<br />
	<br />
	
	<div id="navcontainer">
	<ul>
	<li><a href="search.php?term=coursera">coursera</a></li>
	<li>|</li>
	<li><a href="search.php?term=udacity">udacity</a></li>
	<li>|</li>
	<li><a href="search.php?term=edx">edx</a></li>
	<li>|</li>
	<li><a href="search.php?term=canvas">canvas.net</a></li>
	</ul>
	
	<br />	
    <a href="allcourses.php">all courses</a>

	
	
</body>
</html>