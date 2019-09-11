<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if (isset($_GET['gradeid'])) 
	{
		$id = $_GET['gradeid'];

		$stamt = $pdo->query("DELETE FROM grades WHERE gid = $id");
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
		<h2>Personal Tutor Management</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				<li><a href="grades.php"> Provide Grade</a></li>
				<li><a href="editgrades.php"> Edit Grade</a></li>
				<li><a href="deletegrades.php"> Delete Grade</a></li>
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="addForm">
				<form method="POST">
					<?php 
						$getData = $pdo -> prepare("SELECT * from grades");
						$getData->execute();

						foreach ($getData as $storedValue) 
						{
							$sid = $storedValue['sid'];
							$a = $pdo->prepare("SELECT * FROM students WHERE student_id =$sid ");
							$a->execute();
							foreach ($a as $key) 
							{
								echo '<li>' .$key['firstname']." ".$key['surname']. '<a href = "deletegrades.php?gradeid='.$storedValue['gid'].'"> Delete</a> </li>';
							}
						}
					?>
				</form>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>