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
			<form method="POST" action="attendance-sheet.php">
				<h3 style="text-align: left; margin-left: -20px;">Module Wise Attendance</h3>
				<label>Semester:</label>
				<select id="semester" name="semester">
					<?php 
						for ($num=1; $num <= 8; $num++) {
							echo '<option value="'.$num.'">'.$num.'</option>';
						}
					?>
				</select><br><br>
				<label>Course:</label>
				<select id="course" name="course">
					<?php
						$course = $pdo->prepare("SELECT * FROM courses");
						$course->execute();
						foreach ($course as $keyCourse) {
							echo '<option value='.$keyCourse['course_id'].'>'.$keyCourse['course_title'].'</option>';
						}
					?>
				</select><br><br>
				<label>Module:</label>
				<select id="module" name="module">
						<?php
						$module = $pdo->prepare("SELECT s.*, m.*
								FROM staff s
								JOIN modules m
								ON s.subject = m.module_code
								");
						$module->execute();
						foreach ($module as $keyModule) {
							echo '<option value='.$keyModule['module_code'].'>'.$keyModule['module_title'].'</option>';
						}
					?>
				</select><br><br>
				<input type="submit" name="submit" value="Submit">
			</form><br><br><br>
			
			<hr style="margin-right: 57%;">
			<h3 style="text-align: left;  margin-left: -20px;">OR</h3><br>
			<hr style="margin-right: 57%; margin-top: -25px; margin-bottom: -5px"><br><br>
			<h3 style="text-align: left; margin-left: -20px;">Student Wise Attendance</h3>
			
			<form method="POST" action="attendance-sheet1.php">
				<label>Student</label>
				<select name="student">
					<?php 
						$std = $pdo->prepare("SELECT * FROM students");
						$std->execute();
						foreach ($std as $key) {
							echo '<option value="'.$key['student_id'].'">'.$key['firstname'].' '.$key['surname'].'</option>';
						}
					?>
				</select><br><br>
				<input type="submit" name="submitStdnt">
			</form>
		</div>
	</div>
</section>

<?php 
	require 'footer.php';
?>