<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';

	if (isset($_GET['assignmentid'])) 
	{
		$asid = $_GET['assignmentid'];

		$executerVar = $pdo -> prepare("SELECT * FROM assignment WHERE aid = :asgnid");
		$dataGiver = [
			'asgnid' => $asid
		];
		$executerVar -> execute($dataGiver);
		$recordGiver = $executerVar -> fetch();

		if(isset($_POST['submit']))
		{
			$updaterVar = $pdo -> prepare ("UPDATE assignment SET 
			 		atitle = :atitle,
			 		atutor = :atutor,
			 		atype = :atype,
			 		alevel = :alevel,
			 		aterm = :aterm,
			 		amodule = :amodule,
			 		sdate = :sdate,
			 		edate = :edate
					WHERE 
					aid = :asid");
					unset($_POST['submit']);
					$finalUpate = $updaterVar -> execute($_POST);
			if ($_FILES['afile']['error'] == 0) 
			{
				$fileName = $asid.'.pdf';
				move_uploaded_file($_FILES['afile']['tmp_name'], 'assignment/' . $fileName);
			}
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
		<h2>Assignment</h2>
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
					<?php 
						$getData = $pdo -> prepare("SELECT * from assignment WHERE archiveID = 0");
						$getData->execute();

						foreach ($getData as $storedValue) 
						{
							echo '<li>' .$storedValue['atitle']. '<a href = "editAssignment.php?assignmentid='.$storedValue['aid'].'"> Edit</a> </li>';
						}
					?>
					<br><br>

					<input type="hidden" name="asid"  value="<?php echo $asid?>">

					<label>Assignment Title</label>
					<input type="text" name="atitle" value="<?php if(isset($recordGiver['atitle'])) echo $recordGiver['atitle']?>"><br><br>

					<label>Assignment Tutuor</label>
					<select name="atutor">
						<?php 
							$tut = $pdo->prepare("SELECT * FROM staff WHERE position='ML/PL'");
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
					<input type="Date" name="sdate" value="<?php if(isset($recordGiver['sdate'])) echo $recordGiver['sdate']?>"><br><br>

					<label>End-Date</label>
					<input type="Date" name="edate" value="<?php if(isset($recordGiver['edate'])) echo $recordGiver['edate']?>"><br><br>

					<label>Assignment Files</label>
					<input type="file" name="afile"><br><br>

					<input type="submit" name="submit" value="Edit Assignment"/>
				</form>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>