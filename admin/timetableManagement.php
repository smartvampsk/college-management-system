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
		<h2>Time Table Management</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				<li><a href="timetableManagement.php"> View </a></li>
				<li><a href="addTimeTableManagement.php"> Add </a></li>
				<li><a href="editTimeTableManagement.php"> Edit </a></li>
				<li><a href="deleteTimeTableManagement.php"> Delete </a></li>
				<li><a href="archiveTimeTableManagement.php"> Archive </a></li>
				<li><a href="restoreTimeTableManagement.php"> Restore </a></li>
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
					<th style="padding: 20px;">First Period</th>
					<th style="padding: 20px;">Second Period</th>
					<th style="padding: 20px;">Third Period</th>
					<th style="padding: 20px;">Fourth Period</th>
				</tr>

				<?php

				$output = $pdo-> query("SELECT * FROM timetables WHERE archiveID = 0");
				foreach ($output as $row) {?>

					<tr>
						<td style="padding: 17px;"> <?php echo $row['tday']?></td>
						<td style="padding: 17px;"> <?php echo $row['tdate']?></td>
						<td style="padding: 17px;"> <?php echo "Tutor Name:  " .$row['ftutor']."<br>". "Module Name:  ".$row['fmodule']." <br>"."Starting Time:  ".$row['fstime']."<br> "."Ending Time:  ".$row['fetime'] ?></td>

						<td style="padding: 17px;"> <?php echo "Tutor Name:  " .$row['stutor']."<br>". "Module Name:  ".$row['smodule']." <br>"."Starting Time:  ".$row['sstime']."<br> "."Ending Time:  ".$row['setime'] ?></td>

						<td style="padding: 17px;"> <?php echo "Tutor Name:  " .$row['ttutor']."<br>". "Module Name:  ".$row['tmodule']." <br>"."Starting Time:  ".$row['tstime']."<br> "."Ending Time:  ".$row['tetime'] ?></td>

						<td style="padding: 17px;"> <?php echo "Tutor Name:  " .$row['fotutor']."<br>". "Module Name:  ".$row['fomodule']." <br>"."Starting Time:  ".$row['fostime']."<br> "."Ending Time:  ".$row['foetime'] ?></td>
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