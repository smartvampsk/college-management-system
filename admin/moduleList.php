<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	error_reporting(0);
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
		<h2>Module Management</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				<li><a href="addModule.php"> Add Module</a></li>
				<li><a href="editModule.php"> Edit Module</a></li>
				<li><a href="viewModule.php"> View Module</a></li>
				<li><a href="deleteModule.php"> Delete Module</a></li>
				<li><a href="archiveModule.php"> Archive Module</a></li>
				<li><a href="unarchiveModule.php"> Unarchive Module</a></li>
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="archiveData">
				<form method="POST">
				<label>Select Module</label>
				<select name="selectedMod">
					<?php
							$module = $pdo->prepare("SELECT * FROM modules");
							$module->execute();
							foreach ($module as $keyModule) {
								echo '<option value='.$keyModule['module_code'].'>'.$keyModule['module_title'].'</option>';
							}
						?>
				</select>
				<input type="submit" name="submit" value="View"><br><br>
				</form>

				<table border="2" cellpadding="10" cellspacing="5">
				<tr>
					<th style="padding: 20px;">Weeks</th>
					<th style="padding: 20px;">Description</th>
					<th style="padding: 20px;">Files</th>
				</tr>

				<?php
				if (isset($_POST['submit'])) 
				{
					$id = $_POST['selectedMod'];
				}

				$output = $pdo-> query("SELECT * FROM modules WHERE module_code = $id");
				foreach ($output as $row) {?>
					<tr>
						<td style="padding: 20px;"> <?php echo $row['week']?></td>
						<td style="padding: 20px;"> <?php echo $row['description']?></td>
						<td style="padding: 20px;">

							<?php
							if (file_exists('file/' . $row['module_code'] . '.pdf')) 
							{
								echo '<a href="file/' . $row['module_code']  . '.pdf">'.$row['week']. '</a>';
							}
							?>

						</td>
					<?php }
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