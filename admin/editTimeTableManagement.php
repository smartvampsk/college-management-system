<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if(isset($_GET['editid']))
	{
		$taid = $_GET['editid'];

		$executerVar = $pdo -> prepare("SELECT * FROM timetables WHERE tid = :editid");
		$dataGiver = [
			'editid' => $taid
		];
		$executerVar -> execute($dataGiver);
		$recordGiver = $executerVar -> fetch();
		if (isset($_POST['submit'])) 
		{
			$updaterVar = $pdo -> prepare ("UPDATE timetables SET 
		 		tday = :tday,
		 		tdate = :tdate,
		 		ftutor = :ftutor,
		 		fmodule = :fmodule,
		 		fstime = :fstime,
		 		fetime = :fetime,
		 		stutor = :stutor,
		 		smodule = :smodule,
		 		sstime = :sstime,
		 		setime = :setime,
		 		ttutor = :ttutor,
		 		tmodule = :tmodule,
		 		tstime = :tstime,
		 		tetime = :tetime,
		 		fotutor = :fotutor,
		 		fomodule = :fomodule,
		 		fostime = :fostime,
		 		foetime = :foetime
				WHERE 
				tid = :tdid");
				unset($_POST['submit']);
				$finalUpate = $updaterVar -> execute($_POST);
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
					<?php 
						$getData = $pdo -> prepare("SELECT * from timetables WHERE archiveID = 0");
						$getData->execute();

						foreach ($getData as $storedValue) 
						{
							echo '<li>' .$storedValue['tday']." ".$storedValue['tdate'] .'<a href ="editTimeTableManagement.php?editid='.$storedValue['tid'].'"> Edit</a> </li>';
						}
					?>
					<br><br>
					<input type="hidden" name="tdid"  value="<?php echo $taid?>">

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
					<input type="date" name="tdate" value="<?php if(isset($recordGiver['adate'])) echo $recordGiver['adate'] ?>">
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
						<input type="text" name="fstime" value="<?php if(isset($recordGiver['fstime'])) echo $recordGiver['fstime'] ?>"><br><br>


						<label>Ending Time</label>
						<input type="text" name="fetime" value="<?php if(isset($recordGiver['fetime'])) echo $recordGiver['fetime'] ?>"><br><br>

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
						<input type="text" name="sstime" value="<?php if(isset($recordGiver['sstime'])) echo $recordGiver['sstime'] ?>" ><br><br>


						<label>Ending Time</label>
						<input type="text" name="setime" value="<?php if(isset($recordGiver['setime'])) echo $recordGiver['setime'] ?>"><br><br>


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
						<input type="text" name="tstime" value="<?php if(isset($recordGiver['tstime'])) echo $recordGiver['tstime'] ?>"><br><br>


						<label>Ending Time</label>
						<input type="text" name="tetime" value="<?php if(isset($recordGiver['tetime'])) echo $recordGiver['tetime'] ?>"><br><br>


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
						<input type="text" name="fostime" value="<?php if(isset($recordGiver['fostime'])) echo $recordGiver['fostime'] ?>"><br><br>

						<label>Ending Time</label>
						<input type="text" name="foetime" value="<?php if(isset($recordGiver['foetime'])) echo $recordGiver['foetime'] ?>"><br><br>

						<input type="submit" name="submit" value="Update TimeTable">
				</form>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>