<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
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
		<h2>Dairy Management</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				<li><a href="addDiary.php"> Add Details</a></li>
				<li><a href="editDiary.php"> Edit Details</a></li>
				<li><a href="prompt.php"> Prompt </a></li>
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="archiveData">
				<?php
				include 'databaseConnection/connectdb.php';
					$getData = $pdo -> prepare("SELECT * from diarymanagement");
					$getData->execute();

					foreach ($getData as $storedValue) 
					{
						echo '<li>'.$storedValue['title'].'</li>';
					}
				?>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>