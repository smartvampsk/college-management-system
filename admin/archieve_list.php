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
		<h2>Archive List</h2>
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
				include 'databaseConnection/connectdb.php';

				$stmt =$pdo->query("SELECT * FROM staff_archieve");
				$stmt->execute();

				foreach ($stmt as $row) {?>
					<tr>
						<td> <?php echo $row['fname']?></td>
						<td> <?php echo $row['sname']?></td>
						<td> <?php echo $row['dob']?></td>
						<td> <?php echo $row['position']?></td>
						<td> <?php echo $row['email']?></td>
						<td> <?php echo $row['contact']?></td>
						<td> <?php echo $row['address']?></td>
						<td> 
							<a href="unarchieve.php?rid=<?php echo $row['s_id']?>" style="list-style-type: none; text-decoration: none; "> Unarchieve </a>	
						</td>
					</tr>
				<?php
			}
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