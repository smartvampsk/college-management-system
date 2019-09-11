<?php  
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if (isset($_GET['arId'])) 
	{
		$id = $_GET['arId'];

		$statmt = $pdo->prepare("SELECT * FROM courses WHERE course_id = '$id'");
		$statmt->execute();

		foreach ($statmt as $row) {
			$c_title = $row['course_title'];
			$c_weight = $row['credit_weight'];
			$level = $row['level'];

			$arch = $pdo->prepare("INSERT INTO archive_courses(c_title, c_weight, level)
									VALUES('$c_title', '$c_weight', '$level')");
			$arch->execute();
			if($arch){ 
				$pdo->query("DELETE FROM courses WHERE course_id = '$id'");
			}	
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
		<h2>Archive Course</h2>
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
						echo '<li>'.$row['course_title'].'  / --- /  '.'<a href="archiveCourse.php?arId='.$row['course_id'].'">Archive</a></li>';
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