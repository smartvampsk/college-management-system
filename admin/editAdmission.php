<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if (isset($_GET['admissionid'])) 
	{
		$aid = $_GET['admissionid'];

		$executerVar = $pdo -> prepare("SELECT * FROM admission WHERE id = :admissionid");
		$dataGiver = [
			'admissionid' => $aid
		];
		$executerVar -> execute($dataGiver);
		$recordGiver = $executerVar -> fetch();
		if (isset($_POST['submit'])) 
		{
			$updaterVar = $pdo -> prepare ("UPDATE admission SET 
		 		firstname = :firstname,
				lastname = :lastname,
				email = :email,
				contactnumber = :contactnumber,
				gender = :gender,
				schoolname = :schoolname,
				spercentage = :spercentage,
				highschool = :highschool,
				hpercentage = :hpercentage,
				bachelor = :bachelor,
				bpercentage = :bpercentage,
				course = :course
				WHERE 
				id = :did ");
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
		<?php require 'header.php'; ?>
	</header>
	<div class="menubar">
		<h2>Admission</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				<li><a href="admissionindex.php">Admission Process</a></li>
				<li><a href="exportStudents.php">Export Students</a></li>
				<li><a href="editAdmission.php">Edit Students</a></li>
				<li><a href="deleteAdmission.php">Delete Students</a></li>
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="addForm">
				<form method="POST" action="">
					<?php 
						$getData = $pdo -> prepare("SELECT * from admission");
						$getData->execute();

						foreach ($getData as $storedValue) 
						{
							echo '<li>' .$storedValue['firstname'].' '.$storedValue['lastname'] .'<a href = "editAdmission.php?admissionid='.$storedValue['id'].'"> Edit</a> </li>';
						}
					?>


					<h3>Personal Details:</h3>
						<input type="hidden" name="did"  value="<?php echo $aid?>">
						<label>First Name: </label>
						<input type="text" name="firstname" value="<?php if(isset($recordGiver['firstname'])) echo $recordGiver['firstname'] ?>"> <br><br>

						<label>Surname: </label>
						<input type="text" name="lastname" value="<?php if(isset($recordGiver['lastname'])) echo $recordGiver['lastname'] ?>"><br><br>

						<label>Email address: </label>
						<input type="text" name="email" value="<?php if(isset($recordGiver['email'])) echo $recordGiver['email'] ?>"><br><br>

						<label>Contact number: </label>
						<input type="text" name="contactnumber" value="<?php if(isset($recordGiver['contactnumber'])) echo $recordGiver['contactnumber'] ?>" ><br><br>

						<label>Gender</label>
						<input type="radio" name="gender" value="Male" checked="">Male 
						<input type="radio" name="gender" value="Female">Female
						<br><br><hr><br><br>

						<h3>Educational Qualifications:</h3><br>

						<label>School Name:</label><textarea name="schoolname"><?php if(isset($recordGiver['schoolname'])) echo $recordGiver['schoolname'] ?></textarea>

						<label>Percentage:</label><input type="text" name="spercentage"value="<?php if(isset($recordGiver['spercentage'])) echo $recordGiver['spercentage'] ?>" ><br><br>

						<label>High School:</label><input type="text" name="highschool" value="<?php if(isset($recordGiver['highschool'])) echo $recordGiver['highschool'] ?>" >

						<label>Percentage:</label><input type="text" name="hpercentage" value="<?php if(isset($recordGiver['hpercentage'])) echo $recordGiver['hpercentage'] ?>" ><br><br>

						<label>Bachelor:</label><input type="text" name="bachelor" value="<?php if(isset($recordGiver['bachelor'])) echo $recordGiver['bachelor'] ?>" >

						<label>Percentage:</label><input type="text" name="bpercentage" value="<?php if(isset($recordGiver['bpercentage'])) echo $recordGiver['bpercentage'] ?>" ><br><br><hr><br><br>

						<h3>Choose Course:</h3><br>
						<label>Course:</label>
						<select name="course">
							<?php 
								$course = $pdo->prepare("SELECT * FROM courses");
								$course->execute();
								foreach ($course as $key) {
									echo '<option value="'.$key['course_title'].'">'.$key['course_title'].'</option>';
								}
							?>
						</select><br>
						<input type="submit" name="submit" value="Edit Record">

				</form>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>