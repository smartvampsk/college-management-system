<?php 
	$title = 'WUC - Schedule';
	session_start();
	if (!isset($_SESSION['tutId'])) {
		header('location:../frontend/login.php');
	}
	require 'header.php';
?>
<section class="schedule-section">
	<div class="main-section-row3">
	<div class="main-section-row3col1">
		<h3>Class Schedule</h3>
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
			$output = $pdo-> query("SELECT * FROM timetables");
			foreach ($output as $row) {?>

				<tr>
					<td style="padding: 17px;"> <?php echo $row['tday']?></td>
					<td style="padding: 17px;"> <?php echo $row['tdate']?></td>
					<td style="padding: 17px;"> <?php echo "<u>Tutor Name:</u>  " .$row['ftutor']."<br>". "<u>Module Name:</u>  ".$row['fmodule']." <br>"."<u>Starting Time</u>:  ".$row['fstime']."<br> "."<u>Ending Time:</u>  ".$row['fetime'] ?></td>

					<td style="padding: 17px;"> <?php echo "<u>Tutor Name:</u>  " .$row['stutor']."<br>". "<u>Module Name:</u>  ".$row['smodule']." <br>"."<u>Starting Time:</u>  ".$row['sstime']."<br> "."<u>Ending Time:</u> ".$row['setime'] ?></td>

					<td style="padding: 17px;"> <?php echo "<u>Tutor Name:</u>  " .$row['ttutor']."<br>". "<u>Module Name:</u>  ".$row['tmodule']." <br>"."<u>Starting Time:</u>  ".$row['tstime']."<br> "."<u>Ending Time:</u>  ".$row['tetime'] ?></td>

					<td style="padding: 17px;"> <?php echo "<u>Tutor Name: </u> " .$row['fotutor']."<br>". "<u>Module Name: </u> ".$row['fomodule']." <br>"."<u>Starting Time: </u> ".$row['fostime']."<br> "."<u>Ending Time: </u> ".$row['foetime'] ?></td>
				</tr>
				<?php }
			?>
		</table><br><br>
	</div>
</div>
</section>

<?php 
	require 'footer.php';
?>