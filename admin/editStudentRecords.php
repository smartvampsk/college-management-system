<?php 
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if(isset($_GET['s_id'])){
		$s_id = $_GET['s_id'];
		$stmt = $pdo->prepare("SELECT * FROM students WHERE student_id = :s_id");
		$criteria = [
			's_id' => $s_id
		];
		$stmt->execute($criteria);
		$row = $stmt->fetch();
	}
	if(isset($_POST['update'])){
		extract($_POST);
		$result = $pdo->query("UPDATE students 
								SET
									firstname = '$firstname',
									surname = '$surname',
									email = '$email',
									contactNumber = '$contactNumber',
									gender = '$gender',
									status = '$status',
									address = '$address',
									assID = '$assID',
									course_id = '$course_id'
									WHERE
										student_id = '$s_id'");
		if($result == true){
			header('location:index.php');
		}
		else echo "Not updated";

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
			<article class="addForm">
				<form method="POST" action="">	
					<input type="hidden" name="id" value="<?php if(isset($s_id)) echo $s_id;?>">

					<label>Level</label>
					<select name="status">
						<option value="4"> Level 4</option>
						<option value="5"> Level 5 </option>
						<option value="6"> 	Level 6</option>
					</select><br><br>

					<label>First Name:</label>
					<input type="text" name="firstname" value="<?php if(isset($row['firstname'])) echo $row['firstname'];?>"><br><br>

					<label>SurName:</label>
					<input type="text" name="surname" value="<?php if(isset($row['surname'])) echo $row['surname'];?>"><br><br>

					<label>Email:</label>
					<input type="text" name="email" value="<?php if(isset($row['email'])) echo $row['email'];?>"><br><br>

					<label>Contact Number:</label>
					<input type="text" name="contactNumber" value="<?php if(isset($row['contactNumber'])) echo $row['contactNumber'];?>"><br><br>

					<label>Address</label>
					<input type="text" name="address" value="<?php if(isset($row['address'])) echo $row['address'];?>"><br><br>

					<label>Student Assigned ID</label>
					<input type="text" name="assID" value="<?php if(isset($row['assID'])) echo $row['assID'];?>"><br><br>

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

					<label>Gender:</label>
					<input type="radio" name="gender" value="Male" checked>Male
					<input type="radio" name="gender" value="Female">Female<br><br>

					<input type="submit" name="update" value="Update">
				</form>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>