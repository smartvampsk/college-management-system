<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
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
		<h2>Student Management</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				<li><a href="addStudentRecords.php">Add Records</a></li>
				<li><a href="restoreStudentRecords.php">Restore Records</a></li>
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="studentR">
			<h3>Students Details</h3>
				<table border="2">	
					<thead>
						<tr>
							<th>SN</th>
							<th>First Name</th>
							<th>Surname</th>
							<th>Email</th>
							<th>Contact Number</th>
							<th>Gender</th>
							<th>Status </th>
							<th>AssignedID </th>
							<th>Address </th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$stmt = $pdo -> prepare("SELECT * FROM students
												WHERE archive = 1"); $sn = 1;
							$stmt -> execute();
							foreach ($stmt as $row) {?>
								<tr>
									<td> <?php echo $sn++; ?></td>
									<td><?php echo $row['firstname']; ?></td>
									<td><?php echo $row['surname']; ?></td>
									<td><?php echo $row['email']; ?></td>
									<td><?php echo $row['contactNumber']; ?></td>
									<td><?php echo $row['gender']; ?></td>
									<td><?php echo $row['status']; ?></td>
									<td><?php echo $row['assID']; ?></td>
									<td><?php echo $row['address']; ?></td>
									<td><?php echo '<a href="editStudentRecords.php?s_id='.$row['student_id'].'">Edit</a> 
									<a href="deleteStudentRecords.php?s_id='.$row['student_id'].'">Delete</a>
									<a href="archiveStudentRecords.php?s_id='.$row['student_id'].'">Archive</a>'
									; ?></td>
								</tr>
							<?php }
						?>
					</tbody>
				</table>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>