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
		<h2>Assignement</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				<li><a href="addAssignment.php"> Add Assignment</a></li>
				<li><a href="editAssignment.php"> Edit Assignment</a></li>
				<li><a href="viewAssignment.php"> View Assignment</a></li>
				<li><a href="deleteAssignment.php"> Delete Assignment</a></li>
				<li><a href="archiveAssignment.php">  Archive Assignment</a></li>
				<li><a href="restoreAssignment.php">  Restore Assignment</a></li>
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="studentR">
				<table border="2" cellpadding="10" cellspacing="5">
				<tr>
					<th style="padding: 20px;">Title</th>
					<th style="padding: 20px;">Tutor</th>
					<th style="padding: 20px;">Level</th>
					<th style="padding: 20px;">Term</th>
					<th style="padding: 20px;">Dates</th>
					<th style="padding: 20px;">Files</th>
				</tr>

				<?php

				$output = $pdo-> query("SELECT * FROM assignment WHERE archiveID = 0");
				foreach ($output as $row) {?>

					<tr>
						<td style="padding: 17px;"> <?php echo $row['atitle']?></td>
						<td style="padding: 17px;"> <?php echo "Tutor Name:  " .$row['atutor'] ?> </td>
 
						<td style="padding: 17px;"> <?php echo "Level:  " .$row['alevel'] ?></td>

						<td style="padding: 17px;"> <?php echo " Term:  " .$row['aterm'] ?></td>

						<td style="padding: 17px;"> <?php echo "Starting Time:  ".$row['sdate']."<br> "."Ending Time:  ".$row['edate'] ?></td>

						<td style="padding: 17px;">
							<?php
							if (file_exists('assignment/' . $row['aid'] . '.pdf')) 
							{
								echo '<a href="assignment/' . $row['aid']  . '.pdf">'.$row['atitle']. '</a>';
							}
							?>
						<td>
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