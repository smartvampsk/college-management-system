<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
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
		<h2>Attendance Management - Take Attendance</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				<li><a href="attendanceIndex.php"> Take Attendance</a></li>
				<li><a href="viewAttendance.php"> View Attendance</a></li>
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="addForm">
				<h3 style="margin-left: 57%; margin-bottom: -26px; padding-top: 40px;">Module Wise Attendance</h3>
				<form method="POST" action="attendance-sheet.php">
					<label>Semester:</label>
					<select id="semester" name="semester">
						<?php 
							for ($num=1; $num <= 8; $num++) {
								echo '<option value="'.$num.'">'.$num.'</option>';
							}
						?>	
					</select><br><br>
					<label>Course:</label>
					<select id="course" name="course">
						<?php
							$course = $pdo->prepare("SELECT * FROM courses");
							$course->execute();
							foreach ($course as $keyCourse) {
								echo '<option value='.$keyCourse['course_id'].'>'.$keyCourse['course_title'].'</option>';
							}
						?>
					</select><br><br>
					<label>Module:</label>
					<select id="module" name="module">
							<?php
							$module = $pdo->prepare("SELECT * FROM modules");
							$module->execute();
							foreach ($module as $keyModule) {
								echo '<option value='.$keyModule['module_code'].'>'.$keyModule['module_title'].'</option>';
							}
						?>
					</select><br><br>
					<input type="submit" name="submit" value="Submit">
				</form><br><br><br><hr style="margin-left: 57%;">
				<h3 style="margin-left: 57%; margin-bottom: -16px; text-align: center;">OR</h3><br><hr style="margin-left: 57%;"><br><br>
				<h3 style="margin-left: 57%; margin-bottom: -16px;">Student Wise Attendance</h3>
				<form method="POST" action="attendance-sheet1.php">
					<label>Student</label>
					<select name="student">
						<?php 
							$std = $pdo->prepare("SELECT * FROM students");
							$std->execute();
							foreach ($std as $key) {
								echo '<option value="'.$key['student_id'].'">'.$key['firstname'].' '.$key['surname'].'</option>';
							}
						?>
					</select><br><br>
					<input type="submit" name="submitStdnt">
				</form>
			</article><br><br><br><br>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>