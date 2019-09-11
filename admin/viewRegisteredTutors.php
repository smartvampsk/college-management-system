<?php
	include 'databaseConnection/connectdb.php';

	if(isset($_GET['did']))
	{
	
		$did = $_GET['did'];
		$answer = $pdo->query("DELETE FROM staff WHERE s_id = '$did' ");
	}

	if (isset($_GET['aid'])) 
	{
		$id = $_GET['aid'];

		$stmt = $pdo->prepare("SELECT * FROM staff WHERE s_id = '$id'");
		$stmt->execute();

		foreach ($stmt as $row) {
			$fname = $row['fname'];
			$sname = $row['sname'];
			$dob = $row['dob'];
			$position = $row['position'];
			$email = $row['email'];
			$contact = $row['contact'];
			$address = $row['address'];

			$arch = $pdo->prepare("INSERT INTO staff_archieve(fname, sname, dob, position, email, contact, address)
									VALUES('$fname', '$sname', '$dob', '$position', '$email', '$contact', '$address')");
			$arch->execute();
			if($arch){  	
				$pdo->query("DELETE FROM staff WHERE s_id = '$id'");
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
		<h2>Tutor Management</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				<li><a href="registerTutors.php">Register Tutor</a></li>
				<li style="width: 250px; padding-left: 50px;"><a href="viewRegisteredTutors.php"> View Registered Tutors</a></li>
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="studentR">
			<h3>Registered Tutor Details</h3>
				<h3> Record List</h3>
				<table border="2">
				
				<tr>
					<th>Tutor Id</th>
					<th>First Name</th>
					<th>Surname</th>
					<th>Username</th>
				</tr>

				<?php

				$output = $pdo-> prepare("SELECT r.*, s.* 
					FROM registutors r
					JOIN staff s
					ON r.tutor_id = s.s_id
					");
				$output->execute();
				foreach ($output as $row) {?>
					<tr>
						<td style="padding: 1px 10px;"> <?php echo $row['tutor_id']; ?></td>
						<td style="padding: 1px 10px;"> <?php echo $row['fname']; ?></td>
						<td style="padding: 1px 10px;"> <?php echo $row['sname']; ?></td>
						<td style="padding: 1px 10px;"> <?php echo $row['username']; ?></td>
					</tr>
					<?php }
				?>
			</table>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>