<?php 
	$title = "WUC - Login";
	session_start();
	include '../databaseConnection/connectdb.php';
	require 'header.php';
	if (isset($_SESSION['tutId'])) {
		header('location:../tutor/index.php');
	}
?>

<?php  
	if(isset($_POST['submit'])){
		$stmt = $pdo->prepare("SELECT * FROM regisstudent WHERE username =:username");
		$criteria = ['username'=> $_POST['username']];
		$error = false;
		$stmt -> execute($criteria);
		if($stmt->rowCount()>0){
			$user = $stmt->fetch();
			if(password_verify($_POST['password'], $user['password'])){
				$_SESSION['stdId'] = $user['std_id'];
				header('location:../student/index.php');
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
			<label><?php if (isset($_SESSION['stdId'])) {
				echo $_SESSION['stdId'];
			} ?></label>
		</form>
	</div>
</section>
<?php
	require 'footer.php';
?>