<?php 
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
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
		<h2>Student Records</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				<li><a href="addStudentRecords.php">Add Records</a></li>
				<li><a href="restoreStudentRecords.php">Restore Records</a></li>
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="archiveData">
				<?php  
					include 'databaseConnection/connectdb.php';
					$stmt = $pdo->query("SELECT * FROM students
											WHERE archive = 0");
					foreach ($stmt as  $key) {
						echo '<li>'.$key['firstname']."  ".$key['surname']."  ".$key['email'].' 
						<a href="getStudentRecords.php?s_id='.$key['student_id'].'">Restore</a></li>';
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