<?php 
	$title = 'Module';
	error_reporting(0);
	session_start();
	$stdId = $_SESSION['tutId'];
	$mId = $_SESSION['mId'];
	
	if (!isset($_SESSION['tutId'])) {
		header('location:../frontend/login.php');
	}
	require 'header-module.php';

	if (isset($_POST['submit'])) 
	{
		$statement = $pdo->prepare("INSERT INTO submitted_assignment(submit_id, assignment_id, module_id, student_id)
			VALUES(' ', :assignment_id, :module_id, :student_id )");
		$dataProcessor=[
			'assignment_id' => $_POST['assignment_id'],
			'module_id' => $_POST['module_id'],
			'student_id' => $_POST['student_id']
		];
		unset($_POST);
		$result = $statement->execute($dataProcessor);

		if ($_FILES['afile']['error'] == 0) 
		{
			$fileName = $pdo->lastInsertId() .'.pdf';
			move_uploaded_file($_FILES['afile']['tmp_name'], '../submitted_assignment/' . $fileName);
		}
	}
?>

<?php			
	$stdnt = $pdo->prepare("SELECT * FROM staff WHERE s_id = '$stdId'");
	$stdnt->execute();

	if (isset($_GET['mId'])) {
		$mId = $_GET['mId'];
		foreach ($stdnt as $key) {
			echo 'Welcome <b>'.$key['fname'].' '.$key['sname'].' !</b><br><br>';
		}
		$mdule = $pdo->prepare("SELECT * FROM modules WHERE module_code = '$mId'");
		$mdule->execute();
		foreach ($mdule as $key) {
			echo 'You are on module :- <b>'.$key['module_title'].' - '.$key['description'].'</b>';
		}
	}


	if (isset($_GET['aId'])) {
		$output = $pdo-> query("SELECT * FROM assignment WHERE archiveID = 0 AND amodule = '$mId'");
		$out = $output->fetch();
		$output->execute();
		if ($out['amodule'] != null) {?>
			<h3><u>Assignment</u></h3>
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
					foreach ($output as $row) {?>
					<tr>
						<td style="padding: 17px;"> <?php echo $row['atitle']?></td>
						<td style="padding: 17px;"> <?php echo "Tutor Name:  " .$row['atutor'] ?> </td>
						<td style="padding: 17px;"> <?php echo "Level:  " .$row['alevel'] ?></td>
						<td style="padding: 17px;"> <?php echo " Term:  " .$row['aterm'] ?></td>
						<td style="padding: 17px;"> <?php echo "Starting Time:  ".$row['sdate']."<br> "."Ending Time:  ".$row['edate'] ?></td>
						
						<?php
						if (file_exists('../admin/assignment/' . $row['aid'] . '.pdf')) {
							echo '<td style="padding: 17px;"><a href="../admin/assignment/' . $row['aid']  . '.pdf">'.$row['atitle']. '</a></td>';
						}
						?>
				</tr>
				<?php }
				?>
			</table><br><br>
		<?php }
		else{
			echo '<h3><u>Assignment</u></h3>';
			echo '<h4>You don\'t have any assignment currently.</h4>';
		}
		echo '<a href="addAssignment.php?assId='.$mId.'">Add Assignment</a><br><br><br>';
	}


	if (isset($_GET['sId'])) {
		echo "<h3>Slides</h3>";
		$output = $pdo-> query("SELECT * FROM modules WHERE module_code = $mId");
			foreach ($output as $row) {?>
				<tr>
					<td style="padding: 20px;"> <?php echo $row['week']?></td>
					<td style="padding: 20px;"> <?php echo $row['description']?><br></td>
					<td style="padding: 20px;">
						<?php
						if (file_exists('../admin/file/' . $row['module_code'] . '.pdf')) {
							echo '<a href="../admin/file/' . $row['module_code']  . '.pdf">'.$row['module_code'].'.pdf'. '</a>';
						}
						?>
					</td><br><br><br>
					<a href="addSlides.php">Add Slides</a><br><br><br>
				<?php }
	}


	if (isset($_GET['cId'])) {
		echo "<h3>Contact</h3><br>";
		$tutor = $pdo->prepare("SELECT *
			FROM staff s
			JOIN modules m
			ON s.subject = m.module_code
			WHERE m.module_code = '$mId'
			");
		$tutor->execute();
		foreach ($tutor as $key) {
			echo 'My Mail address: <a href="mailto:'.$key['email'].'">'.$key['email'].'</a>';			
		}
	}

	if (isset($_GET['swId'])) {
		$output = $pdo-> query("SELECT s.*, a.* 
			FROM submitted_assignment s
			JOIN assignment a
			ON s.assignment_id = a.aid
			WHERE module_id = '$mId'");
		$out = $output->fetch();
		$output->execute();
		if ($out['module_id'] != null) {?>
			<h3><u>Assignment</u></h3>
			<table border="2" cellpadding="10" cellspacing="5">
				<tr>
					<th style="padding: 20px;">Submit ID</th>
					<th style="padding: 20px;">Assignment Title</th>
					<th style="padding: 20px;">Student ID</th>
					<th style="padding: 20px;">Submitted Work</th>
				</tr>
				<?php
					foreach ($output as $row) {?>
					<tr>
						<td style="padding: 17px;"> <?php echo $row['submit_id']?></td>
						<td style="padding: 17px;"> <?php echo $row['atitle']?></td>
						<td style="padding: 17px;"> <?php echo $row['student_id']; ?> </td>
						<?php
						if (file_exists('../submitted_assignment/' . $row['submit_id'] . '.pdf')) {
							echo '<td style="padding: 17px;"><a href="../submitted_assignment/' . $row['submit_id']  . '.pdf">'.$row['submit_id'].'.pdf'. '</a></td>';
						}
						?>
				</tr>
				<?php }
				?>
			</table><br><br>
		<?php }
		else{
			echo '<h3><u>Assignment</u></h3>';
			echo '<h4>No assignment have been submitted yet.</h4>';
		}
		echo '<a href="addAssignment.php?assId='.$mId.'">Add Assignment</a><br><br><br>';
	}
?>

<?php 
	require 'footer-module.php';
?>