<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if(isset($_GET['editid']))
	{
		$taid = $_GET['editid'];

		$executerVar = $pdo -> prepare("SELECT * FROM etimetables WHERE etid = :editid");
		$dataGiver = [
			'editid' => $taid
		];
		$executerVar -> execute($dataGiver);
		$recordGiver = $executerVar -> fetch();

		if (isset($_POST['submit'])) 
		{
			$updaterVar = $pdo -> prepare ("UPDATE etimetables SET 
		 		eday = :eday,
		 		edate = :edate,
		 		emodule = :emodule,
		 		estime = :estime,
		 		eetime = :eetime
				WHERE 
				etid = :tdid");
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
					<?php 
						$getData = $pdo -> prepare("SELECT * from etimetables WHERE archiveID=0");
						$getData->execute();

						foreach ($getData as $storedValue) 
						{
							echo '<li>' .$storedValue['eday']." ".$storedValue['edate'] .'<a href ="examEditTimeTableManagement.php?editid='.$storedValue['etid'].'"> Edit</a> </li>';
						}
					?>
					<br><br>
					<input type="hidden" name="tdid"  value="<?php echo $taid?>">

					<label>Day</label>
					<select name="eday">
						<option value="Sunday">Sunday</option>
						<option value="Monday">Monday</option>
						<option value="Tuesday">Tuesday</option>
						<option value="Wednesday">Wednesday</option>
						<option value="Thursday">Thursday</option>
						<option value="Friday">Friday</option>
					</select><br><br>
					<hr>	

					<label>Date</label>
					<input type="date" name="edate" value="<?php if(isset($recordGiver['edate'])) echo $recordGiver['edate'] ?>">
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
					<input type="text" name="estime" value="<?php if(isset($recordGiver['estime'])) echo $recordGiver['estime'] ?>"><br><br>


					<label>Ending Time</label>
					<input type="text" name="eetime" value="<?php if(isset($recordGiver['eetime'])) echo $recordGiver['eetime'] ?>"><br><br>

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