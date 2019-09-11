<?php 
	$title = 'WUC - Grading';
	session_start();
	if (!isset($_SESSION['tutId'])) {
		header('location:../frontend/login.php');
	}
	require 'header.php';

	if (isset($_POST['submitgrade']))
	{
		$stamt = $pdo->prepare("INSERT INTO grades(sid,asid,mid,grade,marks)
								VALUES(:sid,:asid,:mid,:grade,:marks)");
		$processor=[
			'sid' => $_POST['selSt'],
			'asid' => $_POST['selAs'],
			'mid' => $_POST['selMo'],
			'grade' => $_POST['selGr'],
			'marks' => $_POST['selMa']
		];
		unset($_POST);
		$res = $stamt->execute($processor);	
	}

?>

<section class="schedule-section">
	<div class="main-section-row0">
		<div class="gradingNav">
		 <nav>
		 	<ul>
		 		<li><a href="grades.php">Provide Grade</a></li>
		 		<li><a href="grades.php?gId=1">View Grade</a></li>
		 	</ul>
		 </nav>
		</div>
		<div class="grading">
			<?php 
				if (isset($_GET['gId'])==1){

					?>
					<h3 style="margin-top: -10px; margin-left: -20px;">View Grades</h3>
					<form method="POST">
					<label>Select Module</label>
					<select name="mId">
						<?php
								$module = $pdo->prepare("SELECT s.*, m.*
										FROM staff s
										JOIN modules m
										ON s.subject = m.module_code
										");
								$module->execute();
								foreach ($module as $keyModule) {
									echo '<option value='.$keyModule['module_code'].'>'.$keyModule['module_title'].'</option>';
								}
							?>
					</select><br><br>
					<input type="submit" name="submit" value="View Grades"><br><br>
					<?php
					if (isset($_POST['submit'])) {?>
						<table border="2" cellpadding="10" cellspacing="5">
							<tr>
								<th style="padding: 20px;">Student-Id</th>
								<th style="padding: 20px;">Module</th>
								<th style="padding: 20px;">Marks</th>
								<th style="padding: 20px;">Grade</th>
							</tr>
							<?php
							$mId = $_POST['mId'];
							$output = $pdo->prepare("SELECT * 
								FROM modules m 
								JOIN courses c
								ON m.course_id = c.course_id
								JOIN students s
								ON s.course_id = c.course_id
								JOIN grades g 
								ON g.sid = s.student_id
								WHERE module_code = $mId");
							$output->execute();
							foreach ($output as $key) {?>
								<tr>
									<td style="padding: 17px;"> <?php echo $key['student_id'] ?></td>
									<td style="padding: 17px;"> <?php echo $key['module_title'] ?></td>
									
									<td style="padding: 17px;"> <?php echo $key['marks']?></td>
									<td style="padding: 17px;"> <?php echo $key['grade']?></td>
								</tr>
							<?php } ?>
					</table><br><br>
					<?php }
				}
				else { ?>
				 	<form method="POST">
				 		<h3 style="margin-top: -10px; margin-left: -20px;">Give Grades</h3>
						<label>Select Module</label>
						<select name="selMo">
							<?php
								$module = $pdo->prepare("SELECT s.*, m.*
								FROM staff s
								JOIN modules m
								ON s.subject = m.module_code
								");
								$module->execute();

								foreach ($module as $keyModule) 
								{
									echo '<option value='.$keyModule['module_code'].'>'.$keyModule['module_title'].'</option>';
								}
							?>
						</select><br><br>
						<label>Select Assignment</label>
						<select name="selAs">
							<?php
									$module = $pdo->prepare("SELECT * FROM assignment");
									$module->execute();
									foreach ($module as $keyModule) 
									{
										echo '<option value='.$keyModule['aid'].'>'.$keyModule['atitle'].'</option>';
									}
								?>
						</select><br><br>

						<label>Select Student</label>
						<select name="selSt">
							<?php
									$module = $pdo->prepare("SELECT * FROM students");
									$module->execute();
									foreach ($module as $keyModule) 
									{
										echo '<option value='.$keyModule['student_id'].'>'.$keyModule['firstname']." ".$keyModule['surname']. '</option>';
									}
								?>
						</select><br><br>

						<label>Give Grades</label>
						<select name="selGr">
							<option value="A+">A+</option>
							<option value="A">A</option>
							<option value="A-">A-</option>
							<option value="B+">B+</option>
							<option value="B">B</option>
							<option value="B-">B-</option>
							<option value="C+">C+</option>
							<option value="C">C</option>
							<option value="C-">C-</option>
							<option value="D+">D+</option>
							<option value="D">D</option>
							<option value="D-">D-</option>
							<option value="F">F</option>
						</select><br><br>

						<label>Marks Obtained</label>
						<input type="text" name="selMa"><br><br>
						
						<input type="submit" name="submitgrade" value="Give Grade">
					</form>
				<?php } ?>
		</div>
	</div>
</section>
<?php 
	require 'footer-module.php';
?>