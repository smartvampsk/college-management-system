<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if (isset($_GET['deleId'])) 
	{
		$id = $_GET['deleId'];

		$stamt = $pdo->query("DELETE FROM courses WHERE course_id = $id");
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
		<h2>Course</h2>
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
			<article class="archiveData">
				<ul>
					<?php  
						$stamt = $pdo->prepare("SELECT * FROM courses");
						$stamt->execute();

						foreach ($stamt as $row) {
							echo '<li>'.$row['course_title'].'  / --- /  '.'<a href="deleteCourse.php?deleId='.$row['course_id'].'">Delete</a></li>';
						}
					?>	
				</ul>
				<a href="courseList.php">Go to course list</a>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>