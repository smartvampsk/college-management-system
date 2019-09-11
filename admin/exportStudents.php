<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';

	include ("import-export.php");
	$excelWork = new excelWork();

	if (isset($_POST['export'])) {
		$excelWork->export();
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
			<article class="addForm">
				<form action="" method="POST" enctype="multipart/form-data">
					<input type="submit" name="export" value="Export">
				</form>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>