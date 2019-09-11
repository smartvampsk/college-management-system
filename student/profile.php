<?php 
	$title = "WUC - Personal Detail";
	session_start();
	if (!isset($_SESSION['stdId'])) {
		header('location:../frontend/login.php');
	}
	require 'header.php';
	$stdId = $_SESSION['stdId'];
	$stmt = $pdo->query("SELECT s.*, c.*, m.* 
		FROM students s
		JOIN courses c
		ON s.course_id = c.course_id
		JOIN modules m
		ON c.course_id = m.course_id
		WHERE student_id =  $stdId
		AND m.level = s.status");
	$student = $stmt->fetch();
?>

<section class="profile-section">
	<div class="main-section-row3">
		<div class="main-section-row3col1">
			<h3>Your Profile</h3><hr><hr>
			<form>
				<h4><u>Personal Detail:</u></h4>

				<label>Name:</label><input disabled type="text" value=" <?php echo $student['firstname'].' '.$student['surname']; ?> "><br><br>
				<label>Email:</label><input disabled type="text" value=" <?php echo  $student['email']; ?> "><br><br>
				<label>Contact No.:</label><input disabled type="text" value=" <?php echo  $student['contactNumber']; ?> "><br><br>
				<label>Gender:</label><input disabled type="text" value=" <?php echo  $student['gender']; ?> "><br><br><br><hr>
				<h4><u>Course Detail:</u></h4>
				<label>Course:</label><input disabled type="text" value=" <?php echo  $student['course_title']; ?> "><br><br>
				<label>Modules:</label>
					<textarea rows="6" cols="25" style="margin-right: 28px; float: right;" disabled=""><?php foreach($stmt as $mod) {echo $mod['module_title'].', '; }?> </textarea><br><br><br><br><br><br><br><hr>
				<h4><u>Account:</u></h4>
				<label>Username:</label><input disabled type="text" value=" <?php echo  $student['email']; ?> "><br><br>
			</form><br><br>
		</div>
	</div>
</section>
<?php
	require 'footer.php';
?>