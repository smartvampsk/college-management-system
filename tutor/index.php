<?php 
	$title = "WUC - Home";
	session_start();
	if (!isset($_SESSION['tutId'])) {
		header('location:../frontend/login.php');
	}
	require 'header.php';
	$stdId = $_SESSION['tutId'];
?>
<section class="main-section">
	<div class="main-section-row0">
		<div class="main-section-row0col1">
			<h3>Welcome</h3>
			<?php 
				$tut = $pdo->prepare("SELECT * FROM staff WHERE s_id = '$stdId'");
				$tut->execute();
				foreach ($tut as $tt) {
					echo '<ul><b>'.$tt['fname'].' '.$tt['sname'].'</b><br>Have a good time</ul>';
				}				
			?>
		</div>
		<div class="main-section-row0col2">
			<h3>Your Modules:</h3>
			<ul>
				<?php
					$module = $pdo->prepare("SELECT s.*, m.*
						FROM staff s
						JOIN modules m
						ON s.subject = m.module_code
						");
					$module->execute();
					foreach ($module as $m) {
						echo '<li><a href="module.php?mId='.$m['module_code'].'">'.$m['module_title'].' - '.$m['description'].'</a></li><br>';
					}
				?>
			</ul>
		</div>
	</div>
	<div class="main-section-row1">
		<div class="main-section-row1col1">
			<h3>Learning Resources</h3>
			<ul>
				<li><a href="https://www.nelson.com">NELSON</a></li><br>
				<li><a href="https://coursera.org">Coursera</a></li><br>
				<li><a href="https://www.codecademy.com">Code Academy</a></li><br>
			</ul>
		</div>
		<div class="main-section-row1col2">
			<h3>Notice</h3>
			<p><b>Examination Time and Date Fixed</b></p>
			<p>Your exam is fixalhlgkelwajk khghsulikjw fnhheakyu flijkhkaeryiuf lhjhwiaygdkuf hjkaw hhadk jfkhahdkwj ajek jwda  hjhaeyulfh hi EKULFH </p>
			<p><a href="notice.php">Read More...</a></p>
		</div>
	</div>
	<div class="main-section-row3">
		<div class="main-section-row3col1">
			<h3>Class Schedule</h3>
			<table border="2">
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
						<td style="padding: 17px;"> <?php echo "Tutor Name:  " .$row['ftutor']."<br>". "Module Name:  ".$row['fmodule']." <br>"."Starting Time:  ".$row['fstime']."<br> "."Ending Time:  ".$row['fetime'] ?></td>

						<td style="padding: 17px;"> <?php echo "Tutor Name:  " .$row['stutor']."<br>". "Module Name:  ".$row['smodule']." <br>"."Starting Time:  ".$row['sstime']."<br> "."Ending Time:  ".$row['setime'] ?></td>

						<td style="padding: 17px;"> <?php echo "Tutor Name:  " .$row['ttutor']."<br>". "Module Name:  ".$row['tmodule']." <br>"."Starting Time:  ".$row['tstime']."<br> "."Ending Time:  ".$row['tetime'] ?></td>

						<td style="padding: 17px;"> <?php echo "Tutor Name:  " .$row['fotutor']."<br>". "Module Name:  ".$row['fomodule']." <br>"."Starting Time:  ".$row['fostime']."<br> "."Ending Time:  ".$row['foetime'] ?></td>
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