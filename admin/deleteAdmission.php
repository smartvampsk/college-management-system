<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if (isset($_GET['deleId'])) 
	{
		$id = $_GET['deleId'];

		$stamt = $pdo->query("DELETE FROM admission WHERE id = $id");
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
			<article class="archiveData">
				<ul>
					<?php  
						$stamt = $pdo->prepare("SELECT * FROM admission");
						$stamt->execute();

						foreach ($stamt as $row) {
							echo '<li>'.$row['firstname'].' '.$row['lastname'].' / --- /  '.'<a href="deleteAdmission.php?deleId='.$row['id'].'">Delete</a></li>';
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