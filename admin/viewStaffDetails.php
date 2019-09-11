<?php

	session_start();
	include 'sessionNotSet/sessionNotSet.php';
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
		<h2>Staff Management</h2>
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
			<article class="studentR">
			<h3>Staff Details</h3>
				<h3> Record List</h3>
				<table border="2">
				
				<tr>
					<th>First Name</th>
					<th>Surname</th>
					<th>Date Of Birth</th>
					<th>Position</th>
					<th>Email</th>
					<th>Contact</th>
					<th>Address</th>
				</tr>

				<?php

				$output = $pdo-> query("SELECT * FROM staff");
				foreach ($output as $row) {?>

					<tr>
						<td> <?php echo $row['fname']?></td>
						<td> <?php echo $row['sname']?></td>
						<td> <?php echo $row['dob']?></td>
						<td> <?php echo $row['position']?></td>
						<td> <?php echo $row['email']?></td>
						<td> <?php echo $row['contact']?></td>
						<td> <?php echo $row['address']?></td>
						<td> 
							<a href="edit_data.php?uid=<?php echo $row['s_id']?>" style="list-style-type: none; text-decoration: none; "> Edit </a>
							<a href="viewStaffDetails.php?did=<?php echo $row['s_id']?>" style="list-style-type: none; text-decoration: none; "> Delete </a>
							<a href="viewStaffDetails.php?aid=<?php echo $row['s_id']?>" style="list-style-type: none; text-decoration: none; "> Archive</a>
						</td>
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