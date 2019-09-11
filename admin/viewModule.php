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
		<h2>View Module</h2>
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
					include 'databaseConnection/connectdb.php';
					
					$stamt = $pdo->prepare("SELECT * FROM modules");
					$stamt->execute();

					foreach ($stamt as $row) 
					{
						echo '<li>'.$row['module_title'].'  / ---/  '.'<a href="editModule.php?eId='.$row['module_code'].'">Edit</a></li>';
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