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
	<style type="text/css">
		input[type="radio"]{margin: 0; padding: 0; margin-left: -15px;}
	</style>
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
				<li><a href="viewAttendance.php"> View Attendance</a></li>
				<li><a href="attendanceIndex.php"> Attendance Sheet</a></li>
			</ul>
		</nav>
	</div>
	<?php
		$date = date("d-M-Y");

		if (isset($_POST['submitStdnt'])) {
			$_SESSION["student"] = $_POST['student'];
			$selected_student = $_SESSION['student'];
			$studntName = $pdo->query("SELECT * FROM students WHERE student_id = '$selected_student'");
			$stdntName = $studntName->fetch();
			$courseId = $stdntName['course_id'];
			$studntCourse = $pdo->query("SELECT * FROM courses WHERE course_id = '$courseId'");
			$stdntCourse = $studntCourse->fetch();
		}
	?>
	<main>
		<?php
			$selected_student = $_SESSION['student'];
		 	require 'sidebar.php';
		 ?>
		<section class="attendance">
			<form>
				<label>Student Id:</label><input type="text" name="sid" placeholder="<?php echo $selected_student; ?>" disabled><br><br>
				<label>Name of Student: </label><input type="text" name="stdnt" placeholder="<?php echo $stdntName['firstname'].' '.$stdntName['surname'] ; ?>" disabled><br><br>
				<label>Course: </label><input type="text" name="course" placeholder="<?php echo $stdntCourse['course_title']; ?>" disabled><br><br>
				<label>Date: </label><input type="text" name="date" placeholder="<?php echo $date; ?>" disabled><br><br>
			</form>

			<table border="2" width="910px" class="attendance-table">
				<thead>
					<tr>
						<th>SN</th>
						<th>Module</th>
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
							WHERE s.student_id = '$selected_student'");
						$stmt->execute();
						foreach ($stmt as $key) {?>
							<tr>
								<td><?php echo $sn++; ?>
								<td><?php echo $key['module_title']; ?></td>
								<td>
								<form method="POST" id="pal" action="submitAttend1.php">
									<input type="hidden" name="s_id" value="<?php echo $key['student_id']; ?>">
									<input type="hidden" name="module_id" value="<?php echo $key['module_code']; ?>">
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