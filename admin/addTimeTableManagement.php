<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if (isset($_POST['submit'])) 
	{
		$statement = $pdo->prepare("INSERT INTO timetables(tday,tdate,ftutor,fmodule,fstime,fetime,stutor,smodule,sstime,setime,ttutor,tmodule,tstime,tetime,fotutor,fomodule,fostime,foetime)
			VALUES(:tday,:tdate,:ftutor,:fmodule,:fstime,:fetime,:stutor,:smodule,:sstime,:setime,:ttutor,:tmodule,:tstime,:tetime,:fotutor,:fomodule,:fostime,:foetime)");
		$statementProcessor=[
			'tday' =>  $_POST['tday'],
			'tdate' => $_POST['tdate'],
			'ftutor' => $_POST['ftutor'],
			'fmodule' => $_POST['fmodule'],
			'fstime'=> $_POST['fstime'],
			'fetime' => $_POST['fetime'],
			'stutor' => $_POST['stutor'],
			'smodule' => $_POST['smodule'],
			'sstime' => $_POST['sstime'],
			'setime' => $_POST['setime'],
			'ttutor' => $_POST['ttutor'],
			'tmodule' => $_POST['tmodule'],
			'tstime' => $_POST['tstime'],
			'tetime' => $_POST['tetime'],
			'fotutor'=> $_POST['fotutor'],
			'fomodule' => $_POST['fomodule'],
			'fostime' => $_POST['fostime'],
			'foetime' => $_POST['foetime']
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
				<li><a href="timetableManagement.php"> View </a></li>
				<li><a href="addTimeTableManagement.php"> Add </a></li>
				<li><a href="editTimeTableManagement.php"> Edit </a></li>
				<li><a href="deleteTimeTableManagement.php"> Delete </a></li>
				<li><a href="archiveTimeTableManagement.php"> Archive </a></li>
				<li><a href="restoreTimeTableManagement.php"> Restore </a></li>
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="addForm">
				<form method="POST" action="">
					<label>Day</label>
					<select name="tday">
						<option value="Sunday">Sunday</option>
						<option value="Monday">Monday</option>
						<option value="Tuesday">Tuesday</option>
						<option value="Wednesday">Wednesday</option>
						<option value="Thursday">Thursday</option>
						<option value="Friday">Friday</option>
					</select><br><br>
					<hr>

					<label>Date</label>
					<input type="date" name="tdate">
					<hr>

					<h3> First Period </h3>
						
						<label>Tutor</label>
						<select name="ftutor">
							<?php 
							$tut = $pdo->prepare("SELECT * FROM staff WHERE position='ML/PL'");
							$tut->execute();
							foreach ($tut as $tuto) {
								echo '<option value="'.$tuto['fname'].' '.$tuto['sname'].'">'.$tuto['fname'].' '.$tuto['sname'].'</option>';
							}
						?>
						</select><br><br>

						<label>Module</label>
						<select name="fmodule">
							<?php 
							$tut = $pdo->prepare("SELECT * FROM modules");
							$tut->execute();
							foreach ($tut as $tuto) {
								echo '<option value="'.$tuto['module_title'].'">'.$tuto['module_title'].'</option>';
							}
						?>
						</select><br><br>

						<label>Starting Time</label>
						<input type="text" name="fstime"><br><br>


						<label>Ending Time</label>
						<input type="text" name="fetime"><br><br>

					<hr>


					<h3> Second Period </h3>
						<label>Tutor</label>
						<select name="stutor">
							<?php 
							$tut = $pdo->prepare("SELECT * FROM staff WHERE position='ML/PL'");
							$tut->execute();
							foreach ($tut as $tuto) {
								echo '<option value="'.$tuto['fname'].' '.$tuto['sname'].'">'.$tuto['fname'].' '.$tuto['sname'].'</option>';
							}
						?>
						</select><br><br>

						<label>Module</label>
						<select name="smodule">
							<?php 
							$tut = $pdo->prepare("SELECT * FROM modules");
							$tut->execute();
							foreach ($tut as $tuto) {
								echo '<option value="'.$tuto['module_title'].'">'.$tuto['module_title'].'</option>';
							}
						?>
						</select><br><br>

						<label>Starting Time</label>
						<input type="text" name="sstime"><br><br>


						<label>Ending Time</label>
						<input type="text" name="setime"><br><br>


					<hr>


					<h3> Third Period </h3>
						<label>Tutor</label>
						<select name="ttutor">
							<?php 
							$tut = $pdo->prepare("SELECT * FROM staff WHERE position='ML/PL'");
							$tut->execute();
							foreach ($tut as $tuto) {
								echo '<option value="'.$tuto['fname'].' '.$tuto['sname'].'">'.$tuto['fname'].' '.$tuto['sname'].'</option>';
							}
						?>
						</select><br><br>
						<label>Module</label>
						<select name="tmodule">
							<?php 
							$tut = $pdo->prepare("SELECT * FROM modules");
							$tut->execute();
							foreach ($tut as $tuto) {
								echo '<option value="'.$tuto['module_title'].'">'.$tuto['module_title'].'</option>';
							}
						?>
						</select><br><br>

						<label>Starting Time</label>
						<input type="text" name="tstime"><br><br>


						<label>Ending Time</label>
						<input type="text" name="tetime"><br><br>


					<hr>


					<h3> Fourth Period </h3>
						<label>Tutor</label>
						<select name="fotutor">
							<?php 
							$tut = $pdo->prepare("SELECT * FROM staff WHERE position='ML/PL'");
							$tut->execute();
							foreach ($tut as $tuto) {
								echo '<option value="'.$tuto['fname'].' '.$tuto['sname'].'">'.$tuto['fname'].' '.$tuto['sname'].'</option>';
							}
						?>
						</select><br><br>

						<label>Module</label>
						<select name="fomodule">
							<?php 
							$tut = $pdo->prepare("SELECT * FROM modules");
							$tut->execute();
							foreach ($tut as $tuto) {
								echo '<option value="'.$tuto['module_title'].'">'.$tuto['module_title'].'</option>';
							}
						?>
						</select><br><br>

						<label>Starting Time</label>
						<input type="text" name="fostime"><br><br>

						<label>Ending Time</label>
						<input type="text" name="foetime"><br><br>

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