<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';

	if (isset($_GET['eId']))
	{
		$id = $_GET['eId'];
		$statmt = $pdo->query("SELECT * FROM courses WHERE course_id = '$id'");
		$row = $statmt->fetch();
	}

	if (isset($_POST['submit']))
	{
		extract($_POST);

		$stamt = $pdo->query("UPDATE courses SET
								course_title =  '$title',
								credit_weight = '$credit',
								level = '$level'
								WHERE
								course_id = '$id'
								");

		if ($stamt) header('location:editCourse.php?msg='.$row['course_title'].' is Edited');
		else echo "Not Edited";
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
			<article class="addForm">
				<form method="POST" action="">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<label>Course Title : </label><br>
					<input type="text" name="title" value="<?php if (isset($row['course_title'])) echo $row['course_title']; ?>"><br><br>
					<label>Credit weights : </label><br>
					<input type="text" name="credit" value="<?php if (isset($row['credit_weight'])) echo $row['credit_weight'] ?>"><br><br>
					<label>Course levels : </label><br>
					<input type="text" name="level" value="<?php if (isset($row['level'])) echo $row['level'] ?>"><br><br>
					<input type="submit" name="submit" value="Edit">
			</form>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>