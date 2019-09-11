<?php
	error_reporting(0);
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';

	include ("import-export.php");
	$excelWork = new excelWork();

	if (isset($_POST['submit'])) 
	{
		$excelWork->import($_FILES['file']['tmp_name']);	
	}
	if (isset($_POST['add'])) 
	{
		$addAdmission = $pdo->prepare("INSERT INTO admission(firstname, lastname, email, contactnumber, gender, schoolname, spercentage, highschool, hpercentage, bachelor, bpercentage, course)
			VALUES(:firstname, :lastname, :email, :contactnumber, :gender, :schoolname, :spercentage, :highschool, :hpercentage, :bachelor, :bpercentage, :course)");
		$addProcessor=[
			'firstname'=> $_POST['firstname'],
			'lastname'=> $_POST['lastname'],
			'email'=> $_POST['email'],
			'contactnumber'=> $_POST['contactnumber'],
			'gender'=> $_POST['gender'],
			'schoolname'=> $_POST['schoolname'],
			'spercentage'=> $_POST['spercentage'],
			'highschool'=> $_POST['highschool'],
			'hpercentage'=> $_POST['hpercentage'],
			'bachelor'=> $_POST['bachelor'],
			'bpercentage'=> $_POST['bpercentage'],
			'course'=> $_POST['course']
		];
		$result = $addAdmission->execute($addProcessor);
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
		<?php require 'header.php'; ?>
	</header>
	<div class="menubar">
		<h2>Admission</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				<li><a href="admissionindex.php">Admission Process</a></li>
				<li><a href="exportStudents.php">Export Students</a></li>
				<li><a href="editAdmission.php">Edit Students</a></li>
				<li><a href="deleteAdmission.php">Delete Students</a></li>
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="addForm">
				<form action="" method="POST" enctype="multipart/form-data">
						<h3>Personal Details:</h3>
						<label>First Name: </label>
						<input type="text" name="firstname"><br><br>
						<label>Surname: </label>
						<input type="text" name="lastname"><br><br>
						<label>Email address: </label>
						<input type="text" name="email"><br><br>
						<label>Contact number: </label>
						<input type="text" name="contactnumber"><br><br>
						<label>Gender</label>
						<input type="radio" name="gender" value="Male" checked="">Male 
						<input type="radio" name="gender" value="Female">Female
						<br><br><hr><br><br>

						<h3>Educational Qualifications:</h3><br>
						<label>School Name:</label><textarea name="schoolname"></textarea>
						<label>Percentage:</label><input type="text" name="spercentage"><br><br>
						<label>High School:</label><input type="text" name="highschool">
						<label>Percentage:</label><input type="text" name="hpercentage"><br><br>
						<label>Bachelor:</label><input type="text" name="bachelor">
						<label>Percentage:</label><input type="text" name="bpercentage"><br><br><hr><br><br>

						<h3>Choose Course:</h3><br>
						<label>Course:</label>
						<select name="course">
							<?php 
								$course = $pdo->prepare("SELECT * FROM courses");
								$course->execute();
								foreach ($course as $key) {
									echo '<option value="'.$key['course_title'].'">'.$key['course_title'].'</option>';
								}
							?>
						</select><br><br><hr><br><br>
						<h3>Or import data directly</h3>
						<b>Note:</b>Please upload only CSV type file. <br>
						<input type="file" name="file"><br><br>
					<input type="submit" name="submit" value="Import Record"><br>
					<input type="submit" name="add" value="Add Data">
				</form>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>