<?php 
	$title = "WUC - Personal Detail";
	session_start();
	if (!isset($_SESSION['tutId'])) {
		header('location:../frontend/login.php');
	}
	require 'header.php';
	$stdId = $_SESSION['tutId'];
	$stmt = $pdo->query("SELECT s.*, c.*, m.*, r.*
		FROM staff s
		JOIN modules m
		ON s.subject = m.module_code
		JOIN courses c
		ON m.course_id = c.course_id
		JOIN registutors r
		ON r.tutor_id = s.s_id
		WHERE s.s_id =  $stdId");
	$module = $pdo->prepare("SELECT s.*, m.*
		FROM staff s
		JOIN modules m
		ON s.subject = m.module_code
		");
	$stmt->execute();
	$tut = $stmt->fetch();
	$module->execute();
?>

<section class="profile-section">
	<div class="main-section-row3">
		<div class="main-section-row3col1">
			<h3>Your Profile</h3><hr><hr>
			<form>
				<h4><u>Personal Detail:</u></h4>

				<label>Name:</label><input disabled type="text" value=" <?php echo $tut['fname'].' '.$tut['sname']; ?> "><br><br>
				<label>Email:</label><input disabled type="text" value=" <?php echo  $tut['email']; ?> "><br><br>
				<label>Contact No.:</label><input disabled type="text" value=" <?php echo  $tut['contact']; ?> "><br><br>
				<label>DOB:</label><input disabled type="text" value=" <?php echo  $tut['dob']; ?> "><br><br><br><hr>
				<h4><u>Course Detail:</u></h4>
				<label>Course:</label><input disabled type="text" value=" <?php echo  $tut['course_title']; ?> "><br><br>
				<label>Modules:</label>
					<textarea rows="6" cols="25" style="margin-right: 28px; float: right;" disabled=""><?php foreach ($module as $m) {
						echo $m['module_title'].', ';
					} ?> </textarea><br><br><br><br><br><br><br><hr>
				<h4><u>Account:</u></h4>
				<label>Username:</label><input disabled type="text" value=" <?php echo  $tut['username']; ?> "><br><br>
			</form><br><br>
		</div>
	</div>
</section>
<?php
	require 'footer.php';
?>