<?
	include("dbconnect.php");
	require_once("models/config.php");
	?>
		<div id="head">
		<ul id="headlist">
			<li class="headitem" id="home"><a href='index.php'><em>Saiga.com</em></a></li>
			<li class="headitem">|</li>
			<?php
			if(isUserLoggedIn())
			{
				//User logged in
				?>
					<li class="headitem">Hello <a href='account.php'><?php echo($loggedInUser->displayname) ?></a></li>
					<li class="headitem">|</li>
					<li class="headitem"><a href='logout.php'>Log Out</a></li>
				<?php
			}
			else
			{	
				//User not logged in
				?>
					<li class="headitem"><a href='login.php'>Log In</a></li>
					<li class="headitem">|</li>
					<li class="headitem"><a href='register.php'>Register</a></li>			
				<?php
			}
			?>
		</ul>
		</div>
		<div id="headerbottom">
		</div>
	<?php
?>