<?php 
	$title = 'WUC - Schedule';
	session_start();
	if (!isset($_SESSION['tutId'])) {
		header('location:../frontend/login.php');
	}
	require 'header.php';
?>

<section class="schedule-section">
	<div class="main-section-row0">
		<div class="gradingNav">
		 <nav>
		 	<ul>
		 		<li><a href="attendance.php">Take Attendance</a></li>
		 		<li><a href="viewAttendance.php">View Attendance</a></li>
		 	</ul>
		 </nav>
		</div>
		<div class="grading">
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
			 ?>
			<section class="attendance">
				<form>
					<label>Student Id:</label><input type="text" name="sid" placeholder="<?php echo $selected_student; ?>" disabled><br><br>
					<label>Name of Student: </label><input type="text" name="stdnt" placeholder="<?php echo $stdntName['firstname'].' '.$stdntName['surname'] ; ?>" disabled><br><br>
					<label>Course: </label><input type="text" name="course" placeholder="<?php echo $stdntCourse['course_title']; ?>" disabled><br><br>
					<label>Date: </label><input type="text" name="date" placeholder="<?php echo $date; ?>" disabled><br><br>
				</form>

				<table border="2" class="attendance-table">
					<thead>
						<tr>
							<th>SN</th>
							<th>Module</th>
							<th>Attendance</th>
						</tr>
					</thead>
					<tbody><?php
						$sn = 1;

						$stmt = $pdo->prepare("SELECT *
								FROM students s
								JOIN modules m
								ON s.course_id = m.course_id
								JOIN courses c
								ON m.course_id = c.course_id
								JOIN staff st
								ON st.subject = m.module_code
								WHERE s.student_id = '$selected_student'
								AND m.level = s.status");
							$stmt->execute();
							foreach ($stmt as $key) {?>
								<tr>
									<td width="30px;"><?php echo $sn++; ?>
									<td width="100px;"><?php echo $key['module_title']; ?></td>
									<td width="150px;">
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
		</div>
	</div>
</section>

<?php 
	require 'footer.php';
?>