<?php  
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if (isset($_GET['resId'])) 
	{
		$id = $_GET['resId'];

		$statmt = $pdo->prepare("SELECT * FROM archive_courses WHERE c_id = '$id'");
		$statmt->execute();

		foreach ($statmt as $row) 
		{
			$course_title = $row['c_title'];
			$credit_weight = $row['c_weight'];
			$level = $row['level'];

			$restore = $pdo->prepare("INSERT INTO courses(course_title, credit_weight, level)
									VALUES('$course_title', '$credit_weight', '$level')");
			$restore->execute();
			if($restore)
			{ 
				$pdo->query("DELETE FROM archive_courses WHERE c_id = '$id'");
			}	
			else echo "Not Moved";
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
					$stamt = $pdo->prepare("SELECT * FROM archive_courses");
					$stamt->execute();

					foreach ($stamt as $row) {
						echo '<li>'.$row['c_title'].'  / --- /  '.'<a href="unarchiveCourse.php?resId='.$row['c_id'].'">Restore</a></li>';
					}
				?>	
				</ul>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>