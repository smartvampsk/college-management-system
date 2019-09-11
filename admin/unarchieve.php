<?php 
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
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
			<article class="archiveData">
				<?php
					include 'databaseConnection/connectdb.php';
					if (isset($_GET['rid'])) 
					{
					$id = $_GET['rid'];

					$stmt = $pdo->query("SELECT * FROM staff_archieve WHERE s_id = '$id'");
					$stmt->execute();

					foreach ($stmt as $row) {
						$fname = $row['fname'];
						$sname = $row['sname'];
						$dob = $row['dob'];
						$position = $row['position'];
						$email = $row['email'];
						$contact = $row['contact'];
						$address = $row['address'];

						$restore = $pdo->prepare("INSERT INTO 
														staff(fname, sname, dob, position, email, contact, address)
												VALUES('$fname', '$sname', '$dob', '$position', '$email', '$contact', '$address')");
						$restore->execute();
						if($restore){ 
							$pdo->query("DELETE FROM staff_archieve WHERE s_id = '$id'");
							header('location:staff_record.php');
						}	
						else echo "Not Moved";
					}
				}
			?>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>