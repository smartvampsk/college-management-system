<?php 
	$title = 'WUC - Schedule';
	session_start();
	if (!isset($_SESSION['stdId'])) {
		header('location:../frontend/login.php');
	}
	$stId = $_SESSION['stdId'];
	require 'header.php';
?>
<section class="schedule-section">
	<div class="main-section-row3">
		<div class="grading">
			<h3>Your Grades</h3>
			<?php
				$data = $pdo->prepare("SELECT * FROM grades WHERE sid = $stdId");
				$data->execute();
				?>
					<table border="2" cellpadding="10" cellspacing="5">
						<tr>
							<th style="padding: 20px;">Module</th>
							<th style="padding: 20px;">Grade</th>
							<th style="padding: 20px;">Marks</th>
						</tr>
				<?php
				foreach ($data as $value)
				{
					$one = $value['mid'];
					
					$var = $pdo->prepare("SELECT * FROM modules WHERE module_code = $one");
					$var->execute();
					foreach ($var as $key) 
					{?>
						<tr>
							<td style="padding: 17px;"> <?php echo $key['module_title'] ?></td>
							<td style="padding: 17px;"> <?php echo $value['grade'] ?></td>
							
							<td style="padding: 17px;"> <?php echo $value['marks']?></td>
						</tr>
					<?php	
					}	
				} ?>
			</table>
		</div>
	</div>
</section>

<?php require 'footer.php'; ?>