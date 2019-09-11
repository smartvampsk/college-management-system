<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';

	if(isset($_GET['uid'])){
		$uid = $_GET['uid'];
		$chart = $pdo-> query("SELECT * FROM staff 
								WHERE s_id = '$uid'");

		$chart = $chart->fetch();
	}
	if(isset($_POST['update'])){
		extract($_POST);

		$output = $pdo->query("UPDATE staff SET 
			fname = '$fname',
			sname = '$sname',
			dob = '$dob',
			position = '$position',
			email = '$email',
			contact = '$contact',
			address = '$address',
			subject = '$subject',
			assignedID = '$assignedID',
			status = '$status' 
			WHERE 
			s_id = '$uid'
			");

		if($output == true) header('location:staff_record.php?data=Data Updated');
		else echo 'Not added';
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
		<h2>Staff</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				<a href="viewStaffDetails.php"> View Details</a>
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="addForm">
				<form method="POST" action="">

					<input type="hidden" name="uid"  value="<?php echo $uid; ?>" >
					
					<label>First Name:</label>
					
					<input type="text" name="fname" value="<?php  echo $chart['fname']?>"><br><br>

					<label>Surname:</label>
					<input type="text" name="sname" value="<?php echo $chart['sname']?>"><br><br>

					<label>Date Of Birth:</label>
					<input type="Date" name="dob" value="<?php echo $chart['dob']?>"><br><br>

					<label>Position</label>
					<input type="text" name="position" value="<?php echo $chart['position']?>"><br><br> 

					<label>Email:</label>
					<input type="text" name="email" value="<?php  echo $chart['email']?>"><br><br>

					<label>Contact:</label>
					<input type="text" name="contact" value="<?php echo $chart['contact']?>"><br><br>

					<label>Address:</label>
					<input type="text" name="address" value="<?php echo $chart['address']?>"><br><br>
					
					<label>Staff Record Status</label>
					<select name="status" value="<?php echo $chart['status']?>">
						<option value="Live">Live</option>
						<option value="Dormant">Dormant</option>
					</select><br><br>

					<label>Staff Assigned ID</label>
					<input type="text" name="assignedID" value="<?php echo $chart['assignedID']?>"><br><br>

					<label>Specialist Subject</label>
					<select name="subject">
						<?php
								$module = $pdo->prepare("SELECT * FROM modules");
								$module->execute();
								foreach ($module as $keyModule) {
									echo '<option value='.$keyModule['module_code'].'>'.$keyModule['module_title'].'</option>';
								}
							?>
					</select><br><br>

					<input type="submit" name="update" value="update">
				</form>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>