<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if (isset($_POST['submit'])) 
	{
		$statement = $pdo->prepare("INSERT INTO etimetables(eday,edate,emodule,estime,eetime)
			VALUES(:eday,:edate,:emodule,:estime,:eetime)");
		$statementProcessor=[
			'eday' =>  $_POST['eday'],
			'edate' => $_POST['edate'],
			'emodule' => $_POST['emodule'],
			'estime'=> $_POST['estime'],
			'eetime' => $_POST['eetime']
		];

		$final = $statement->execute($statementProcessor);
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
		<h2>Time Table Management</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				<li><a href="examTimetableManagement.php"> View </a></li>
				<li><a href="examAddTimeTableManagement.php"> Add </a></li>
				<li><a href="examEditTimeTableManagement.php"> Edit </a></li>
				<li><a href="examDeleteTimeTableManagement.php"> Delete </a></li>
				<li><a href="examArchiveTimeTableManagement.php"> Archive </a></li>
				<li><a href="examRestoreTimeTableManagement.php"> Restore </a></li>
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="addForm">
				<form method="POST" action="">
					<label>Day</label>
					<select name="eday">
						<option value="Sunday">Sunday</option>
						<option value="Monday">Monday</option>
						<option value="Tuesday">Tuesday</option>
						<option value="Wednesday">Wednesday</option>
						<option value="Thursday">Thursday</option>
						<option value="Friday">Friday</option>
						<option value="Saturday">Saturday</option>
					</select><br><br>
					<hr>

					<label>Date</label>
					<input type="date" name="edate">
					<hr>	
						<label>Module</label>
						<select name="emodule">
							<?php 
							$tut = $pdo->prepare("SELECT * FROM modules");
							$tut->execute();
							foreach ($tut as $tuto) {
								echo '<option value="'.$tuto['module_title'].'">'.$tuto['module_title'].'</option>';
							}
						?>
						</select><br><br>

						<label>Starting Time</label>
						<input type="text" name="estime"><br><br>


						<label>Ending Time</label>
						<input type="text" name="eetime"><br><br>

					<input type="submit" name="submit" value="Add TimeTable">
				</form>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>