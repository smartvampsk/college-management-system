<?php 
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	$pageTitle = 'Attendance Management - View Attendance';
	require 'header.php';
	include 'databaseConnection/connectdb.php';
?>
	<div class="menubar">
		<h2>Attendance Management - View Attendance</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				<li><a href="attendanceIndex.php"> Take Attendance</a></li>
				<li><a href="viewAttendance.php"> View Attendance</a></li>
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
	<section>
		<form method="POST" action="" id="modu">
			<label>Module: </label>
			<select name="module">
				<option value="all">Select module</option>
				<?php
					$modul = $pdo->prepare("SELECT * FROM modules");
					$modul->execute();
					foreach ($modul as $key) {?>
						<option value="<?php echo $key['module_code'];?>"<?php 
							if (isset($_POST['module'])) {
								if ($key['module_code']==$_POST['module']) {
									echo 'selected'; 
								}
							} ?>> <?php echo $key['module_title']; ?></option>
					<?php }
				?>
			</select>
			<input type="submit" name="submitModule" value="View" id="viewAttend" >
		</form><br>

		<?php
			if (isset($_POST['submitModule'])) {
				$module = $_POST['module'];
				?><table border="2" width="910px" class="attendance-table">
					<thead>
						<tr>
							<th>SN</th>
							<th>Module</th>
							<th>Course</th>
							<th>Student-ID</th>
							<th>Firstname</th>
							<th>Surname</th>
							<th>Total</th>
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
							WHERE m.module_code = '$module'");
						$stmt->execute();
						foreach ($stmt as $key) {?>
							<tr>
								<td><?php echo $sn++; ?>
								<td><?php echo $key['module_title']; ?></td>
								<td><?php echo $key['course_title']; ?></td>
								<td><?php echo $key['student_id']; ?></td>
								<td><?php echo $key['firstname']; ?></td>
								<td><?php echo $key['surname']; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table><?php
			}
			else {
		?>
		<table border="2" width="910px" class="attendance-table">
			<thead>
				<tr>
					<th>SN</th>
					<th>Module</th>
					<th>Course</th>
					<th>Student-ID</th>
					<th>Firstname</th>
					<th>Surname</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody><?php
				$sn = 1;
				$stmt = $pdo->prepare("SELECT s.*, m.*, c.*
					FROM students s
					JOIN courses c
					ON s.course_id = c.course_id
					JOIN modules m
					ON c.course_id= m.course_id
					ORDER BY module_title ASC");
				$stmt->execute();	
				foreach ($stmt as $key) {?>
					<tr>
						<td><?php echo $sn++; ?>
						<td><?php echo $key['module_title']; ?></td>
						<td><?php echo $key['course_title']; ?></td>
						<td><?php echo $key['student_id']; ?></td>
						<td><?php echo $key['firstname']; ?></td>
						<td><?php echo $key['surname']; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php } ?>
	</section>
</main>
<?php 
	require 'footer.php';
?>