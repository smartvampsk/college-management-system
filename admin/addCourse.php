<?php  
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if (isset($_POST['submit']))
	{
		
		$stamt = $pdo->prepare("INSERT INTO courses(course_title, credit_weight, level)
								VALUES(:title, :credit, :level)");
		unset($_POST['submit']);
		$res = $stamt->execute($_POST);
			
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
		<h2>Add Course</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				<li><a href="addCourse.php"> Add Details</a></li>
				<li><a href="editCourse.php"> Edit Details</a></li>
				<li><a href="viewCourse.php"> View Details</a></li>
				<li><a href="deleteCourse.php"> Delete Details</a></li>
				<li><a href="archiveCourse.php"> Archive Details</a></li>
				<li><a href="unarchiveCourse.php"> Unarchive Details</a></li>
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="addForm">
				<form method="POST" action="">
					<label>Course Title : </label><br>
					<input type="text" name="title" required="required"><br><br>
					<label>Credit weights : </label><br>
					<input type="text" name="credit" required="requird"><br><br>
					<label>Course levels : </label><br>
					<input type="text" name="level" required="required"><br><br>
					<input type="submit" name="submit" value="Submit">
					<br><br>
					<a href="courseList.php"> Course List</a>
				</form>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>