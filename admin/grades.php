<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if (isset($_POST['submit']))
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
		$res = $stamt->execute($processor);	
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
		<h2>Personal Tutor Management</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				<li><a href="grades.php"> Provide Grade</a></li>
				<li><a href="editgrades.php"> Edit Grade</a></li>
				<li><a href="deletegrades.php"> Delete Grade</a></li>
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="addForm">
				<form method="POST">
				<label>Select Module</label>
				<select name="selMo">
					<?php
							$module = $pdo->prepare("SELECT * FROM modules");
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
				
				<input type="submit" name="submit" value="Give Grade">
				</form>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>