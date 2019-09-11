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
		<h2>Attendance Management - Take Attendance</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				<li><a href="attendanceIndex.php"> Take Attendance</a></li>
				<li><a href="viewAttendance.php"> View Attendance</a></li>
			</ul>
		</nav>
	</div>
	<?php
		$date = date("d-M-Y");

		if (isset($_POST['submit'])) {
			$_SESSION["sem"] = $_POST['semester'];
			$_SESSION["course"] = $_POST['course'];
			$_SESSION["module"] = $_POST['module'];
			$selected_sem = $_SESSION['sem'];
			$selected_course = $_SESSION['course'];
			$selected_module = $_SESSION['module'];
			$selectedValue1 = $pdo->query("SELECT * FROM courses WHERE course_id = $selected_course");
			$selectedValue2 = $pdo->query("SELECT * FROM modules WHERE module_code = $selected_module");
			$cours = $selectedValue1->fetch();
			$modu = $selectedValue2->fetch();
		}
	?>
	<main>
		<?php
			$selected_sem = $_SESSION['sem'];
			$selected_course = $_SESSION['course'];
			$selected_module = $_SESSION['module'];
		 
		 	require 'sidebar.php'; 
		 ?>
		<section class="attendance">
			<form>
				<label>Semester:</label><input type="text" name="sem" placeholder="<?php echo $selected_sem; ?>" disabled><br><br>
				<label>Course: </label><input type="text" name="course" placeholder="<?php echo $cours['course_title']; ?>" disabled><br><br>
				<label>Module: </label><input type="text" name="module" placeholder="<?php echo $modu['module_title']; ?>" disabled><br><br>	
				<label>Date: </label><input type="text" name="date" placeholder="<?php echo $date; ?>" disabled><br><br>
			</form>

			<table border="2" width="910px" class="attendance-table">
				<thead>
					<tr>
						<th>SN</th>
						<th>Student-ID</th>
						<th>Firstname</th>
						<th>Surname</th>
						<th>Attendance</th>
					</tr>
				</thead>
				<tbody><?php
					$sn = 1;

					$stmt = $pdo->prepare("SELECT s.*, m.*, c.*
							FROM students s
							JOIN modules m
							ON s.course_id = m.course_id
							JOIN courses c
							ON m.course_id = c.course_id
							WHERE m.module_code = '$selected_module'");
						$stmt->execute();
						foreach ($stmt as $key) {?>
							<tr>
								<td><?php echo $sn++; ?>
								<td><?php echo $key['student_id']; ?></td>
								<td><?php echo $key['firstname']; ?></td>
								<td><?php echo $key['surname']; ?></td>
								<td>
								<form method="POST" id="pal" action="submitAttend.php">
									<input type="hidden" name="s_id" value="<?php echo $key['student_id']; ?>">
									<input type="hidden" name="module_id" value="<?php echo $selected_module ?>">
									<input type="radio" name="present" value="P"><label>P</label>
									<input type="radio" name="present" value="A"><label>A</label>
									<input type="radio" name="present" value="AL"><label>AL</label>
									<input type="submit" name="submitRadio" value="submit" id="takeAttend">
								</form>
							</td>
							</tr>
						<?php } ?>
				</tbody>
			</table>
		</section>
	</main>

	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>