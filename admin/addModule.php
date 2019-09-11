<?php  
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if (isset($_POST['submit']))
	{		
		$stamt = $pdo->prepare("INSERT INTO modules(module_title, credit_weight, level, course_id,description,week)
			VALUES(:title, :credit, :level, :course_id,:description,:week)");

		$criteria = [
			'title' => $_POST['title'],
			'credit' => $_POST['credit'],
			'level' => $_POST['level'],
			'course_id' => $_POST['course_id'],
			'description' => $_POST['description'],
			'week' => $_POST['week']
		];
		$res = $stamt->execute($criteria);

		if ($_FILES['resources']['error'] == 0) 
		{
			$fileName = $pdo->lastInsertId() . '.pdf';
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
		<h2>Add Module</h2>
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
					<label>Module Title : </label><br>
					<input type="text" name="title" required="required"><br><br>
					<label>Select Course : </label>
					<select name="course_id">    
						<?php  
							$stamt = $pdo->prepare("SELECT * FROM courses");  
							$stamt->execute();
							foreach ($stamt as $row) { ?>
								<option value="<?php echo $row['course_id']?>">    
									<?php echo $row['course_title']; ?>   
								</option>
						<?php }
						?>

					</select><br><br>
					<label>Credit weights : </label><br>
					<input type="text" name="credit" required="requird"><br><br>

					<label>Module levels : </label><br>
					<select name="level">
						<option value="4">Level 4</option>
						<option value="5">Level 5</option>
						<option value="6">Level 6</option>
					</select><br><br>

					<label>Module Description</label><br>
					<textarea name="description"></textarea><br><br>

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
					<input type="file" name="resources" /><br><br>

					<input type="submit" name="submit" value="Submit">
					<br><br>
					<a href="moduleList.php"> Module List </a>
				</form>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>