<?php  
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if(isset($_POST['submit'])){
		$stmt = $pdo->prepare("INSERT INTO students(firstname, surname, email, contactNumber, gender, archive,status,assID,address,course_id)
									VALUES(:firstname, :surname, :email, :contactNumber, :gender, 1,:status,:assID,:address,:course_id)");
		unset($_POST['submit']);
		$add = $stmt->execute($_POST);
		if($add){
			echo "Record added successfully";
			header('location:studentManagement.php');
		}
		else{
			echo "Record not inserted";
		}
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
		<h2>Add Student Records</h2>
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
			<article class="addForm">
				<form action="" method="POST">
					<label>Level</label>
					<select name="status">
						<option value="4"> Level 4</option>
						<option value="5"> Level 5 </option>
						<option value="6"> 	Level 6</option>
					</select><br><br>

					<label>First Name: </label>
					<input type="text" name="firstname"><br><br>

					<label>Surname: </label>
					<input type="text" name="surname"><br><br>

					<label>Email address: </label>
					<input type="text" name="email"><br><br>

					<label>Contact number: </label>
					<input type="text" name="contactNumber"><br><br>

					<label>Address</label>
					<input type="text" name="address"><br><br>

					<label>Student Assigned ID</label>
					<input type="text" name="assID"><br><br>

					<label>Course Enrolled</label>
					<select name="course_id">
						<?php
							$course = $pdo->prepare("SELECT * FROM courses");
							$course->execute();
							foreach ($course as $keyCourse) {
								echo '<option value='.$keyCourse['course_id'].'>'.$keyCourse['course_title'].'</option>';
							}
						?>
					</select><br><br>

					<label>Gender</label>
					<input type="radio" name="gender" value="Male" checked="">Male 
					<input type="radio" name="gender" value="Female">Female
					<br><br>

					<input type="submit" name="submit" value="Add Record">
				</form>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>