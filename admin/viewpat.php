<?php
	 
	session_start();
	include 'sessionNotSet/sessionNotSet.php';


	include 'databaseConnection/connectdb.php';
	if (isset($_GET['did'])) {
		$did = $_GET['did'];
		$stmt = $pdo->prepare("DELETE FROM pat WHERE pat_id = '$did'");
		$success = $stmt->execute();
		if ($success) {
			header('location:viewPat.php?msg= Successfully deleted');
		}
		else 
			echo "Failed to delete";
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
				<li><a href="addpat.php"> Add Pat</a></li>
				<li><a href="viewpat.php"> View Pat</a></li>
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="archiveData">
				<table border="3" width="700;">
			<thead>
				<tr>
					<th>SN</th>
					<th>Tutor</th>
					<th>Student</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody style="text-align: center;">
				<?php
					$sn = 1;  
					$stmt = $pdo->prepare("SELECT t.*, p.*, s.* FROM staff t
							JOIN pat p
							ON t.s_id = p.tutor
							JOIN students s
							ON p.student = s.student_id
							ORDER BY fname ");
					$stmt->execute();
					foreach ($stmt as $row) {?>
						<tr>
							<td><?php echo $sn++; ?></td>
							<td><?php echo $row['fname'].' '.$row['sname']; ?></td>
							<td><?php echo $row['firstname'].' '.$row['surname']; ?></td>
							<td><?php echo '<a href="editpat.php?eid='.$row['pat_id'].'">Edit</a>'.' | '.'<a href="viewpat.php?did='.$row['pat_id'].'">Remove</a>'; ?></td>
						</tr>
				<?php } ?>
			</tbody>
		</table><br>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>