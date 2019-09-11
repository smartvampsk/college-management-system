<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if (isset($_GET['gradeid'])) 
	{

		$aid = $_GET['gradeid'];

		$executerVar = $pdo -> prepare("SELECT * FROM grades WHERE gid = :gradeid");
		$dataGiver = [
			'gradeid' => $aid
		];
		$executerVar -> execute($dataGiver);
		$recordGiver = $executerVar -> fetch();

		if (isset($_POST['submit']))
		{
		 	
	 		$updaterVar = $pdo -> prepare ("UPDATE grades SET 
	 		sid = :sid,
	 		asid = :asid,
	 		mid = :mid,
	 		grade = :grade,
	 		marks = :marks
			WHERE 
			gid = :did ");
			$criteria = [
				'sid' => $_POST['selSt'],
				'asid' => $_POST['selAs'],
				'mid' =>	$_POST['selMo'],
				'grade' =>	$_POST['selGr'],
				'marks' => $_POST['selMa'],
				'did' => $_POST['did']
			];
			
			$finalUpate = $updaterVar -> execute($criteria);
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
					<?php 
						$getData = $pdo -> prepare("SELECT * from grades");
						$getData->execute();

						foreach ($getData as $storedValue) 
						{
							$sid = $storedValue['sid'];
							$a = $pdo->prepare("SELECT * FROM students WHERE student_id =$sid ");
							$a->execute();
							foreach ($a as $key) 
							{
								echo '<li>' .$key['firstname']." ".$key['surname']. '<a href = "editgrades.php?gradeid='.$storedValue['gid'].'"> Edit</a> </li>';
							}
						}
					?>
					<br><br>
					<input type="hidden" name="did"  value="<?php echo $aid?>">
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
					<input type="text" name="selMa" value="<?php if (isset($storedValue['marks'])) echo $storedValue['marks'] ?>"><br><br>
					
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