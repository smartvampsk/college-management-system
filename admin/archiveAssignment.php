<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if (isset($_GET['archId'])) 
	{
		$id = $_GET['archId'];
		$stamt = $pdo->prepare("UPDATE assignment SET 
			archiveID = '1'
			WHERE aid = '$id'");
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
		<h2>Archive Assignment</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				<li><a href="addAssignment.php"> Add Assignment</a></li>
				<li><a href="editAssignment.php"> Edit Assignment</a></li>
				<li><a href="viewAssignment.php"> View Assignment</a></li>
				<li><a href="deleteAssignment.php"> Delete Assignment</a></li>
				<li><a href="archiveAssignment.php">  Archive Assignment</a></li>
				<li><a href="restoreAssignment.php">  Restore Assignment</a></li>
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="archiveData">
				<ul>
					<?php  
						$stamt = $pdo->prepare("SELECT * FROM assignment WHERE archiveID = 0");
						$stamt->execute();

						foreach ($stamt as $row) 
						{
							echo '<li>'.$row['atitle'].'  / --- /  '.'<a href="archiveAssignment.php?archId='.$row['aid'].'">Archive</a></li>';
						}
					?>	
				</ul>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>