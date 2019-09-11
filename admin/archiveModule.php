<?php  
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if (isset($_GET['arId'])) 
	{
		$id = $_GET['arId'];

		$statmt = $pdo->prepare("SELECT * FROM modules WHERE module_code = '$id'");
		$statmt->execute();

		foreach ($statmt as $row) 
		{
			$m_title = $row['module_title'];
			$c_weight = $row['credit_weight'];
			$level = $row['level'];
			$course_id = $row['course_id'];

			$arch = $pdo->prepare("INSERT INTO archive_modules(m_title, c_weight, level, course_id)
									VALUES('$m_title', '$c_weight', '$level', '$course_id')");
			$arch->execute();
			if($arch)
			{ 
				$pdo->query("DELETE FROM modules WHERE module_code = '$id'");
				echo "Moved to Archive";
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
		<h2>Archive Course</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				<li><a href="addModule.php"> Add Module</a></li>
				<li><a href="editModule.php"> Edit Module</a></li>
				<li><a href="viewModule.php"> View Module</a></li>
				<li><a href="deleteModule.php"> Delete Module</a></li>
				<li><a href="archiveModule.php"> Archive Module</a></li>
				<li><a href="unarchiveModule.php"> Unarchive Module</a></li>
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="archiveData">
				<ul>
					<?php  
						$stamt = $pdo->prepare("SELECT * FROM modules");
						$stamt->execute();

						foreach ($stamt as $row) {
							echo '<li>'.$row['module_title'].'  / --- /  '.'<a href="archiveModule.php?arId='.$row['module_code'].'">Archive</a></li>';
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