<?php
	session_start();
	if (isset($_SESSION['userID']))
	{
		header('location:index.php');
	}
	include 'databaseConnection/connectdb.php';
?>
<?php
	if (isset($_POST['submit']))
	{
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password1 = $_POST['password1'];
		if (empty($name))
		{
			echo "Name cannot be empty";
		}
		else if (empty($email))
		{
			echo "E-mail cannot be empty";
		}
		else if (empty($password))
		{
			echo "Password cannot be empty";
		}
		else if ($password != $password1) 
		{
			echo "Passwords do not match";
		}
		else
		{
			$inputs = $pdo -> prepare("INSERT INTO admins(name,email,password)
				VALUES (:name,:email,:password)");
			$inputProcessor = [
				'name' => $name,
				'email' => $email,
				'password' => sha1($email.$password)
			];
			$inputs -> execute($inputProcessor);
			if($inputs)
			{
				echo "User Registeration Successful";
			}
			else
			{
				echo "Registration Falied";
			}
		}
	}
?>

<!DOCTYPE html> 
<html>
<head>
	<title>
		USER REGISTRATION PAGE
	</title>
</head>
<body>
	<?php require 'header.php';  ?>
	<form method="POST" action="">
			<label>Name</label>
			<input type="text" name="name"><br><br>
		
			<label>E-mail</label>
			<input type="email" name="email"><br><br>

			<label>Password</label>
			<input type="password" name="password"><br><br>
		
			<label>Re-enter Password</label>
			<input type="password" name="password1"><br><br>
			
			<input type="submit" name="submit" value="Register"> 
		<p>
			Already a member? <a href="login.php"> Sign in </a>
		</p>
	</form>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>