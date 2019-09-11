<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if (isset($_GET['archId'])) 
	{
		$id = $_GET['archId'];
		$stamt = $pdo->prepare("UPDATE etimetables SET 
			archiveID = '1'
			WHERE etid = '$id'");
		$stamt->execute();
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
		<h2>Exam Schedule</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				<li><a href="examTimetableManagement.php"> View </a></li>
				<li><a href="examAddTimeTableManagement.php"> Add </a></li>
				<li><a href="examEditTimeTableManagement.php"> Edit </a></li>
				<li><a href="examDeleteTimeTableManagement.php"> Delete </a></li>
				<li><a href="examArchiveTimeTableManagement.php"> Archive </a></li>
				<li><a href="examRestoreTimeTableManagement.php"> Restore </a></li>
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="archiveData">
					<?php 
						$getData = $pdo -> prepare("SELECT * from etimetables  WHERE archiveID = 0");
						$getData->execute();

						foreach ($getData as $storedValue) 
						{
							echo '<li>' .$storedValue['eday']." ".$storedValue['edate'] .'<a href ="examArchiveTimeTableManagement.php?archId='.$storedValue['etid'].'"> Archive </a> </li>';
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