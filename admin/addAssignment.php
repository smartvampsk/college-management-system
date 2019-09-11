<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';

	if (isset($_POST['submit'])) 
	{
		$statement = $pdo->prepare("INSERT INTO assignment(atitle,atutor,atype,alevel,aterm,amodule,sdate,edate)
			VALUES(:atitle,:atutor,:atype,:alevel,:aterm,:amodule,:sdate,:edate)");
		$dataProcessor=[
			'atitle' => $_POST['atitle'],
			'atutor' => $_POST['atutor'],
			'atype' => $_POST['atype'],
			'alevel' => $_POST['alevel'],
			'aterm' => $_POST['aterm'],
			'amodule' => $_POST['amodule'],
			'sdate' => $_POST['sdate'],
			'edate' => $_POST['edate']
		];
		$result = $statement->execute($dataProcessor);

		if ($_FILES['afile']['error'] == 0) 
		{
			$fileName = $pdo->lastInsertId() .'.pdf';
			move_uploaded_file($_FILES['afile']['tmp_name'], 'assignment/' . $fileName);
		}
	}
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
		<h2>Add Assignment</h2>
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
			<article class="addForm">
				<form enctype="multipart/form-data" method="POST">
					<label>Assignment Title</label>
					<input type="text" name="atitle"><br><br>

					<label>Assignment Tutuor</label>
					<select name="atutor">
						<?php 
							$tut = $pdo->prepare("SELECT * FROM staff WHERE position = 'ML/PL'");
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
					<select name="amodule">
						<?php 
							$tut = $pdo->prepare("SELECT * FROM modules");
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
				</form>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>