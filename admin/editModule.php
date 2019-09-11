<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if (isset($_GET['eId']))
	{
		$id = $_GET['eId'];
		$statmt = $pdo->query("SELECT * FROM modules WHERE module_code = '$id'");
		$row = $statmt->fetch();
	}

	if (isset($_POST['submit'])){
		extract($_POST);

		$stamt = $pdo->query("UPDATE modules SET
								module_title =  '$title',
								credit_weight = '$credit',
								level = '$level',
								description = '$description',
								week = '$week'
								WHERE
								module_code = '$id'
								");

		if ($_FILES['resources']['error'] == 0) 
		{
			$fileName = $id.'.pdf';
			move_uploaded_file($_FILES['resources']['tmp_name'], 'file/' . $fileName);
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
		<h2>Module</h2>
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
			<article class="addForm">
				<form method="POST" action="" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<label>Module Title : </label><br>
					<input type="text" name="title" value="<?php if (isset($row['module_title'])) echo $row['module_title']; ?>"><br><br>
					<label>Credit weights : </label><br>
					<input type="text" name="credit" value="<?php if (isset($row['credit_weight'])) echo $row['credit_weight'] ?>"><br><br>
					<label>Module levels : </label><br>
					<input type="text" name="level" value="<?php if (isset($row['level'])) echo $row['level'] ?>"><br><br>

					<label>Module Description</label><br>
					<textarea name="description"><?php if (isset($row['description'])) echo $row['description'] ?></textarea><br><br>

					<label>Week</label><br>
					<select name="week">
						<option value="Week1"> Week1 </option>
						<option value="Week2"> Week2 </option>
						<option value="Week3"> Week3 </option>
						<option value="Week4"> Week4 </option>
						<option value="Week5"> Week5 </option>
						<option value="Week6"> Week6 </option>
						<option value="Week7"> Week7 </option>
						<option value="Week8"> Week8 </option>
						<option value="Week9"> Week9 </option>
						<option value="Week10"> Week10 </option>
						<option value="Week11"> Week11 </option>
						<option value="Week12"> Week12 </option>
						<option value="Week13"> Week13 </option>
						<option value="Week14"> Week14 </option>
					</select><br><br>

					<label>Module Files</label>
					<input type="file" name="resources"><br><br>

					<input type="submit" name="submit" value="Edit">
				</form>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>