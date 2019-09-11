<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if (isset($_GET['deleteid'])) 
	{
		$id = $_GET['deleteid'];

		$stamt = $pdo->query("DELETE FROM timetables WHERE tid = $id");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		HomePage
	</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<header>
		<?php require 'header.php';  ?>
	</header>
	<div class="menubar">
		<h2>Time Table Management</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				<li><a href="timetableManagement.php"> View </a></li>
				<li><a href="addTimeTableManagement.php"> Add </a></li>
				<li><a href="editTimeTableManagement.php"> Edit </a></li>
				<li><a href="deleteTimeTableManagement.php"> Delete </a></li>
				<li><a href="archiveTimeTableManagement.php"> Archive </a></li>
				<li><a href="restoreTimeTableManagement.php"> Restore </a></li>
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="archiveData">
					<?php 
						$getData = $pdo -> prepare("SELECT * from timetables WHERE archiveID = 0");
						$getData->execute();

						foreach ($getData as $storedValue) 
						{
							echo '<li>' .$storedValue['tday']." ".$storedValue['tdate'] .'<a href ="deleteTimeTableManagement.php?deleteid='.$storedValue['tid'].'"> Delete</a> </li>';
						}
					?>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>