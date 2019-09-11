<?php  
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if (isset($_GET['resId'])) 
	{
		$id = $_GET['resId'];

		$statmt = $pdo->prepare("SELECT * FROM archive_modules WHERE m_code = '$id'");
		$statmt->execute();

		foreach ($statmt as $row) 
		{
			$module_title = $row['m_title'];
			$credit_weight = $row['c_weight'];
			$level = $row['level'];
			$course_id = $row['course_id'];

			$restore = $pdo->prepare("INSERT INTO modules(module_title, credit_weight, level, course_id)
									VALUES('$module_title', '$credit_weight', '$level', '$course_id')");
			$restore->execute();
			if($restore){

				$pdo->query("DELETE FROM archive_modules WHERE m_code = '$id'");
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
		<h2>Module</h2>
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
						$stamt = $pdo->prepare("SELECT * FROM archive_modules");
						$stamt->execute();

						foreach ($stamt as $row) {
							echo '<li>'.$row['m_title'].'  / --- /  '.'<a href="unarchiveModule.php?resId='.$row['m_code'].'">Restore</a></li>';
						}
					?>	
				</ul>
				<a href="moduleList.php">Module List</a>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>