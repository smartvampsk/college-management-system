<?php 
	session_start();
	$title = "WUC - Login";
	include '../databaseConnection/connectdb.php';
	require 'header.php';
	if (isset($_SESSION['stdId'])) {
		header('location:../student/index.php');
	}
?>

<?php  
	if(isset($_POST['submit'])){
		$stmt = $pdo->prepare("SELECT * FROM regisstudent WHERE username =:username");
		$stmt1 = $pdo->prepare("SELECT * FROM registutors WHERE username =:username");
		$criteria = ['username'=> $_POST['username']];
		$error = false;
		$stmt -> execute($criteria);
		$stmt1 -> execute($criteria);
		if($stmt->rowCount()>0 || $stmt1->rowCount()>0){
			$user = $stmt->fetch();
			$user1 = $stmt1->fetch();
			if(password_verify($_POST['password'], $user['password'])){
				$_SESSION['stdId'] = $user['std_id'];
				header('location:../student/index.php');
			}
			else if(password_verify($_POST['password'], $user1['password'])){
				$_SESSION["tutId"] = $user1['tutor_id'];
				header('location:../tutor/index.php');
			}
			else
				$error = true;
		}
		else
			$error = true;
		if($error == true){
			?>
			<script type="text/javascript">
				alert("Wrong username or password");
			</script>
			<?php
		}
	}
?>

<section class="loginsection">
	<div class="loginform">
		<img src="../images/login.png">
		<h3>Login</h3><br>
		<form action="" method="POST">
			<input type="text" name="username" placeholder="Username" required><br><br>
			<input type="password" name="password" placeholder="Password" required><br><br>
			<input type="submit" name="submit" value="Login">
		</form>
	</div>
</section>
<?php 
	require 'footer.php';
?>