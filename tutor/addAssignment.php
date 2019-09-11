<?php 
	$title = 'Module';
	session_start();
	$stdId = $_SESSION['tutId'];
	$mId = $_SESSION['mId'];
	
	if (!isset($_SESSION['tutId'])) {
		header('location:../frontend/login.php');
	}
	require 'header-module.php';

	if (isset($_POST['submit'])) 
	{
		$statement = $pdo->prepare("INSERT INTO assignment(atitle,atutor,atype,alevel,aterm,amodule,sdate,edate)
			VALUES(:atitle,:atutor,:atype,:alevel,:aterm,:amodule,:sdate,:edate)");
		$dataProcessor=[
			'atitle' => $_POST['atitle'],
			'atutor' => $stdId,
			'atype' => $_POST['atype'],
			'alevel' => $_POST['alevel'],
			'aterm' => $_POST['aterm'],
			'amodule' => $mId,
			'sdate' => $_POST['sdate'],
			'edate' => $_POST['edate']
		];
		$result = $statement->execute($dataProcessor);

		if ($_FILES['afile']['error'] == 0) 
		{
			$fileName = $pdo->lastInsertId() .'.pdf';
			move_uploaded_file($_FILES['afile']['tmp_name'], '../admin/assignment/' . $fileName);
		}
	}
?>

<?php
	if (isset($_GET['assId'])) { ?>
		<form enctype="multipart/form-data" method="POST">
			<label>Assignment Title</label>
			<input type="text" name="atitle"><br><br>

			<label>Assignment Tutuor</label>
			<select name="atutor" disabled>
				<?php 
					$tut = $pdo->prepare("SELECT * FROM staff WHERE s_id = $stdId");
					$tut->execute();
					foreach ($tut as $tuto)
					{
						echo '<option value="'.$tuto['fname'].' '.$tuto['sname'].'">'.$tuto['fname'].' '.$tuto['sname'].'</option>';
					}
				?>
			</select><br><br>

			<label>Assignment Type</label>
			<select name="atype">
				<option value="Regular">Regular</option>
					<option value="Resit">Resit</option>
			</select><br><br>

			<label>Student's Level</label>
			<select name="alevel">
				<option value="Level 4">Level 4</option>
				<option value="Level 5">Level 5</option>
				<option value="Level 6">Level 6</option>	
			</select><br><br>

			<label>Term</label>
			<select name="aterm">
				<option value="Term 1">Term 1</option>
					<option value="Term 2">Term 2</option>		
			</select><br><br>

			<label>Module</label>
			<select name="amodule" disabled="">
				<?php 
					$tut = $pdo->prepare("SELECT * FROM modules WHERE module_code = $mId");
					$tut->execute();
					foreach ($tut as $tuto) 
					{
						echo '<option value="'.$tuto['module_code'].'">'.$tuto['module_title'].'</option>';
					}
				?>
			</select><br><br>

			<label>Start-Date</label>
			<input type="Date" name="sdate"><br><br>

			<label>End-Date</label>
			<input type="Date" name="edate"><br><br>

			<label>Assignment Files</label>
			<input type="file" name="afile"><br><br>

			<input type="submit" name="submit" value="Add Assignment"/>
		</form>	<br>
	<?php
	echo '<a href="module.php?aId='.$mId.'">Back to Assignment List</a><br><br>';
}
?>

<?php 
	require 'footer-module.php';
?>