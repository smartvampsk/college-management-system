<?php 
	$title = 'Module';
	session_start();
	$stdId = $_SESSION['tutId'];
	$mId = $_SESSION['mId'];
	
	if (!isset($_SESSION['tutId'])) {
		header('location:../frontend/login.php');
	}
	require 'header-module.php';


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
			move_uploaded_file($_FILES['resources']['tmp_name'], '../admin/file/' . $fileName);
		}
	}
?>
	<form method="POST" action="" enctype="multipart/form-data">
		<?php 
			$mdule = $pdo->prepare("SELECT * FROM modules WHERE module_code = '$mId'");
			$mdule->execute();
			$md = $mdule->fetch();
		?>
		<label>Module Title : </label>
		<input type="text" name="title" required="required" value=" <?php echo $md['module_title']; ?> "><br><br>
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
		<label>Credit weights : </label>
		<input type="text" name="credit" required="requird" value=" <?php echo $md['credit_weight'] ?> "><br><br>

		<label>Module levels : </label>
		<select name="level">
			<option value="4">Level 4</option>
			<option value="5">Level 5</option>
			<option value="6">Level 6</option>
		</select><br><br>

		<label>Module Description</label>
		<textarea name="description"> <?php echo $md['description']; ?></textarea><br><br>

		<label>Week</label>
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
	</form><br><br>
	<?php echo '<a href="module.php?sId='.$mId.'">Back to Slide List</a><br><br>'; ?>

<?php require 'footer-module.php'; ?>