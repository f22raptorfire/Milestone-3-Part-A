<?
	include("dbconnect.php");
	require_once("models/config.php"); 
	if(isUserLoggedIn())
	{
		//User logged in
		echo "<p id=\"index\">";
		echo "Hello $loggedInUser->displayname | ";
		echo "<a href='index.php'>Home</a> | ";
		echo "<a href='account.php'> Account</a> | ";
		echo "<a href='logout.php'>Log Out</a>";
		echo "</p>";
	}
	else
	{	
		//User not logged in
		echo "<p>";
		echo "<a href='login.php'>Log In</a> | ";
		echo "<a href='register.php'>Register</a> | ";
		echo "<a href='index.php'>Home</a>";
		echo "</p>";
	}
?>