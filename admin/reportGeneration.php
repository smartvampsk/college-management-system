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
		<h2>Report Generation</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="addForm">
				<form method="POST">
					<label>Select Student</label>
					<select name="studentNumber">
						<?php
								$module = $pdo->prepare("SELECT * FROM students");
								$module->execute();
								foreach ($module as $keyModule) 
								{
									echo '<option value='.$keyModule['student_id'].'>'.$keyModule['firstname']." ".$keyModule['surname']. '</option>';
								}
							?>
					</select><br><br>
					<input type="submit" name="submit" value="Generate Report"><br><br>
					<?php 
						if (isset($_POST['submit'])) 
						{
							$num = $_POST['studentNumber'];
							$data = $pdo->prepare("SELECT * FROM grades WHERE sid = $num");
							$data->execute();
							?>
								<table border="2" cellpadding="10" cellspacing="5">
									<tr>
										<th style="padding: 20px;">Module</th>
										<th style="padding: 20px;">Grade</th>
										<th style="padding: 20px;">Marks</th>
									</tr>
							<?php
							foreach ($data as $value) 
							{
								$one = $value['mid'];
								
								$var = $pdo->prepare("SELECT * FROM modules WHERE module_code = $one");
								$var->execute();
								foreach ($var as $key) 
								{?>
									<tr>
										<td style="padding: 17px;"> <?php echo $key['module_title'] ?></td>
										<td style="padding: 17px;"> <?php echo $value['grade'] ?></td>
										
										<td style="padding: 17px;"> <?php echo $value['marks']?></td>
									</tr>
								<?php	
								}	
							}
							echo "</table>";
						}
					?>
					
				</form>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>