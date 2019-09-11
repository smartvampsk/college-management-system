<?php  
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if(isset($_POST['register']))
	{
		if(empty($error))
		{
			$stmt = $pdo->prepare("INSERT INTO 
									staff(fname, sname, dob, position, email, contact, address,subject,assignedID,status)
									VALUES(:fname, :sname, :dob, :position, :email, :contact, :address,:subject,:assignedID,:status)");
			$info = [
				'fname' => $_POST['fname'],
				'sname' => $_POST['sname'],
				'dob' => $_POST['dob'],
				'position' => $_POST['position'],
				'email' => $_POST['email'],
				'contact' => $_POST['contact'],
				'address' => $_POST['address'],
				'subject' => $_POST['subject'],
				'assignedID' => $_POST['assignedID'],
				'status' => $_POST['status']
			];
			$output = $stmt->execute($info);
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
		<h2>Staff Records</h2>
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
				<form action="" method="POST">
					<form action="" method="POST">
				<label><h1>Enter The Staff Details:</h1></label><br>

				<label>First Name:</label>
				<input type="text" name="fname" required="required"><br><br>

				<label>Surname:</label>
				<input type="text" name="sname" required="required"><br><br>

				<label>Date Of Birth:</label>
				<input type="Date" name="dob" required="required"><br><br>

				<label>Position</label>
				<input type="text" name="position" required="required"><br><br> 

				<label>Email:</label>
				<input type="text" name="email" required="required"><br><br>

				<label>Contact:</label>
				<input type="text" name="contact" required="required"><br><br>

				<label>Address:</label>
				<input type="text" name="address" required="required"><br><br>

				<label>Staff Record Status</label>
				<select name="status">
					<option value="Live">Live</option>
					<option value="Dormant">Dormant</option>
				</select><br><br>

				<label>Staff Assigned ID</label>
				<input type="text" name="assignedID"><br><br>

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

				<input type="submit" name="register" value="Add"><br><br>
				<ul>
					<a href="archieve_list.php" style="list-style-type: none; text-decoration: none; "> <li ><h1>Archive List</h1></li> </a>
				</ul>
				</form>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>