<?php  
	include 'databaseConnection/connectdb.php';
	$stds = $pdo->prepare("SELECT * FROM registutors");
	$stds->execute();
	if(isset($_POST['submit']))
	{
		foreach ($stds as $stdss) {
			if ($_POST['password'] != $_POST['password1']){
				echo '<p>Password don\'t matched</p>';
			}
			if (($stdss['username'] != $_POST['username']) && ($stdss['tutor_id'] != $_POST['tutor_id'])) {
				$stmt = $pdo->prepare("INSERT INTO registutors(tutor_id, username, password)
										VALUES(:tutor_id, :username, :password)");
				$info = [
					'tutor_id' => $_POST['tutor_id'],
					'username' => $_POST['username'],
					'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
				];
				$output = $stmt->execute($info);
				if ($output == true) {
					?>                                                                                                 
					<script type="text/javascript">
						alert("Tutor Registered.");
						window.location.href=('registerTutors.php');
					</script>
					<?php
				}
				else echo "failed";
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Register Tutors
	</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<header>
		<?php require 'header.php';  ?>
	</header>
	<div class="menubar">
		<h2>Tutor Management </h2>
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
		<?php 
			require 'sidebar.php';
			$stmt = $pdo->query("SELECT * FROM staff");
			$stmt->execute();
		?>
		<section>
			<article class="addForm">
			<form action="" method="POST">
				<label><h1>Fill Details of a Tutors:</h1></label><br><br>

				<label>Name of Tutor </label>
					<select name="tutor_id" style="margin-left: 14px; padding-right: 43px;">
						<?php 
							foreach ($stmt as $key) {
								echo '<option value="'.$key['s_id'].'">'.$key['fname'].' '.$key['sname'].'</option>';
							}
						?>
					</select><br><br>
				<label>Username</label>
					<input type="text" name="username" required=""><br><br>
				<label>Password</label>
					<input type="password" name="password" required=""><br><br>
				<label>Re-enter Password</label>
					<input type="password" name="password1" required=""><br><br>
				<input type="submit" name="submit" value="Register">
		</form>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php'; ?>
	</footer>
</body>
</html>