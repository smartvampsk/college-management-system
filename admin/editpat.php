<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	error_reporting(0);

	if (isset($_GET['eid']))
	{
		$eid = $_GET['eid'];
		$stmt = $pdo->query("SELECT * FROM pat
							WHERE pat_id = '$eid'");
		$row = $stmt->fetch();
	}
	if (isset($_POST['cancel']))
	{
		header('location:viewPat.php');
	}

	if (isset($_POST['update'])) 
	{
		$upd = $pdo->prepare("UPDATE pat SET
								tutor = :tutor
								WHERE pat_id = :pat_id");
		$criteria = [
			'tutor'=>$_POST['tutor'],
			'pat_id'=>$_POST['pat_id']
		];
		$upd->execute($criteria);
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
			<article class="addForm">
				<form method="POST" action="">
					<input type="hidden" name="pat_id" value="<?php echo $eid; ?>">
					<?php 
						$stu = $row['student'];
						$st = $pdo->query("SELECT * FROM students WHERE student_id = '$stu'");
						$stut = $st->fetch();
					?>


					<label>Student: </label><input type="text" name="student" value="<?php if(isset($row['student'])) echo $stut['firstname'].' '.$stut['surname']; ?>" disabled><br><br>



					<label>Change Tutor: </label>
					<select name="tutor" style="margin-left: 11px; padding-right: 76px;">
						<?php
							$tut = $pdo->prepare("SELECT * FROM staff");
							$tut->execute();
							foreach ($tut as $tuto) {?>
								<option value="<?php echo $tuto['s_id'];?>" <?php if ($tuto['s_id']==$row['tutor']) {echo 'selected';} ?>> <?php echo $tuto['fname'].' '.$tuto['sname']; ?></option>
							<?php }
						?>
						?>
					</select><br><br>

					<input type="submit" name="update" value="Update">
					<input type="submit" name="cancel" value="Cancel">
				</form>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>