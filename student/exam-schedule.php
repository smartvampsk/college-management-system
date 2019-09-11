<?php 
	$title = 'WUC - Schedule';
	session_start();
	if (!isset($_SESSION['stdId'])) {
		header('location:../frontend/login.php');
	}
	require 'header.php';
?>
<section class="schedule-section">
	<div class="main-section-row3">
	<div class="main-section-row3col1">
		<h3>Exam Schedule</h3>
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
						<td style="padding: 17px; width: 320px;"> <?php echo $row['eday']?></td>
						<td style="padding: 17px; width: 320px;"> <?php echo $row['edate']?></td>
						
						<td style="padding: 17px; width: 340px;"> <?php echo "Module Name:  ".$row['emodule']." <br>"."Starting Time:  ".$row['estime']."<br> "."Ending Time:  ".$row['eetime'] ?></td>
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