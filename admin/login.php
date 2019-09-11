<?php
	session_start();
	include 'databaseConnection/connectdb.php';

	if (isset($_POST['submit']))
	{
		$records = $pdo -> prepare("SELECT * FROM admins WHERE email = :email AND password = :password");

		$recordsProcessor = [
			'email' => $_POST['email'],
			'password' => sha1($_POST['email'].$_POST['password'])
		];

		$records -> execute($recordsProcessor);
		if ($records -> rowCount() > 0) 
		{
			$frontenduser = $records -> fetch();
			$_SESSION['userID'] = $frontenduser['id'];
		}
		else
		{
			echo '<h4> login uncessful </h4>';
		}

		if (isset($_SESSION['userID']))
		{
			header('location:index.php');
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>
		LOGIN PAGE
	</title>
</head>
<body>
	<?php require 'header.php';  ?>
	<form method="POST" action="">
		<label>E-mail</label>
			<input type="email" name="email"><br><br>

			<label>Password</label>
			<input type="password" name="password"><br><br>
			
			<input type="submit" name="submit" value="Login"> 
		<p>
			Not a member? <a href="register.php"> Sign Up </a>
		</p>
	</form>
	<br><br><br><br><br><br><br>
	
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>