<?php  
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';

	$time = time();
	$date = date('Y-m-d @ H:i:s',strtotime('-2week'));
	if (isset($_POST['Filter'])) 
	{
		$statement = $pdo -> prepare("DELETE FROM diarymanagement WHERE adate < :adate");
		$crits= [
		'adate' => $date
		];
		$statement -> execute($crits);
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
		<h2>Dairy</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="archiveData">
				<?php
					$dataFinder = $pdo -> prepare("SELECT * from diarymanagement");
					$dataFinder->execute();

					foreach ($dataFinder as $valueFinder) 
					{
						echo '<li>'.$valueFinder['title']."  ".$valueFinder['adate'].'</li>';
					}
				?>
				<form method="POST" action="">
					<input type="submit" name="Filter" value="Filter">
				</form>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>