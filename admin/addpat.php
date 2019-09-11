<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';

	if (isset($_POST['add'])) {
		$insert = $pdo->prepare("INSERT INTO pat(tutor, student)
					VALUES(:tutor, :student)");
		$criteria = [
			'tutor'=>$_POST['tutor'],
			'student'=>$_POST['student']
		];
		$success = $insert->execute($criteria);
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
				<li><a href="addpat.php"> Add Pat</a></li>
				<li><a href="viewpat.php"> View Pat</a></li>
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="addForm">
				<form method="POST" action="">
					<h3> Assign PAT </h3><br><br>
					<label>Tutor:</label>
					<select name="tutor">
						<?php 
							$tut = $pdo->prepare("SELECT * FROM staff WHERE position='ML/PL'");
							$tut->execute();
							foreach ($tut as $tuto) {
								echo '<option value="'.$tuto['s_id'].'">'.$tuto['fname'].' '.$tuto['sname'].'</option>';
							}
						?>
					</select><br><br>
					<label>Student: </label>
					<select name="student">
						<?php 
							$stu = $pdo->prepare("SELECT * FROM students");
							$stu->execute();
							foreach ($stu as $stud) {
								echo '<option value="'.$stud['student_id'].'">'.$stud['firstname'].' '.$stud['surname'].'</option>';
							}
						?>
					</select><br><br>
					<input type="submit" name="add" value="Add"><br><br><br>
					<a href="viewPat.php">View PAT</a>
				</form><br>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>