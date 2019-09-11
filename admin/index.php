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
</head>
<body>
	<header>
		<?php require 'header.php';  ?>
	</header>
	<div class="menubar">
		<h2>Home Page</h2>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
			<section>
				<?php 
					echo '<h3 style="padding: 40px;">Welcome to admin panel</h3>';
				?>
			</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>