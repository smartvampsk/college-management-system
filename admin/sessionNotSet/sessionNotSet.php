<?php
	if (!isset($_SESSION['userID'])) //checks if session is not set
	{
		header('location:login.php');//if session is not set page is reloaded to login
	}
?>