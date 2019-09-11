<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
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
		<h2>Exam Schedule</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				<li><a href="examTimetableManagement.php"> View </a></li>
				<li><a href="examAddTimeTableManagement.php"> Add </a></li>
				<li><a href="examEditTimeTableManagement.php"> Edit </a></li>
				<li><a href="examDeleteTimeTableManagement.php"> Delete </a></li>
				<li><a href="examArchiveTimeTableManagement.php"> Archive </a></li>
				<li><a href="examRestoreTimeTableManagement.php"> Restore </a></li>
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="studentR">
				<table border="2" cellpadding="10" cellspacing="5">
				<tr>
					<th style="padding: 20px;">Day</th>
					<th style="padding: 20px;">Date</th>
					<th style="padding: 20px;">Module</th>
				</tr>

				<?php

				$output = $pdo-> query("SELECT * FROM etimetables WHERE archiveID = 0");
				foreach ($output as $row) {?>

					<tr>
						<td style="padding: 17px;"> <?php echo $row['eday']?></td>
						<td style="padding: 17px;"> <?php echo $row['edate']?></td>
						
						<td style="padding: 17px;"> <?php echo "Module Name:  ".$row['emodule']." <br>"."Starting Time:  ".$row['estime']."<br> "."Ending Time:  ".$row['eetime'] ?></td>
					</tr>

					<?php }
				?>
			</table>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>