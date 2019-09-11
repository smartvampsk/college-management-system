<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if (isset($_GET['deleId'])) 
	{
		$id = $_GET['deleId'];

		$stamt = $pdo->query("DELETE FROM modules WHERE module_code = $id");
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
						$stamt = $pdo->prepare("SELECT * FROM modules");
						$stamt->execute();

						foreach ($stamt as $row) {
							echo '<li>'.$row['module_title'].'  / --- /  '.'<a href="deleteModule.php?deleId='.$row['module_code'].'">Delete</a></li>';
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