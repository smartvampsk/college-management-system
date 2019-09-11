<!DOCTYPE html>
<html>
<head>
	<title> <?php echo $title; ?> </title>
	<link rel="stylesheet" type="text/css" href="../css/index.css">
	<script type="text/javascript" src="../js/index.js"></script>
</head>
<body>
	<?php require '../databaseConnection/connectdb.php'; $stdId = $_SESSION['stdId']; ?>
	<header id="header">
		<div class="left">
			<img src="../images/Woodlands_Logo.bmp" alt="logo">
		</div>
		<div class="mid">
			<h2>Woodland University College</h2>
		</div>
		<div class="right">
			<form method="POST" id="search">
				<input type="text" name="search" placeholder="search"><button><img src="../images/search.png"></button>
				<input type="submit" name="searched" hidden>
			</form>
		</div>
		<div class="rightdown">
			<button id="login"><a href="logout.php">Logout</a></button>
		</div>
	</header>
	<nav class="mainNav" id="mainNav">
		<ul>
			<li><a href="index.php">Home</a></li>
			<div class="dropdown">
			    <button class="dropbtn"><a >Modules</a></button>
			    <div class="dropdown-content">
			     <?php 
			     	$stmt = $pdo->prepare("SELECT s.*, m.*, c.*
							FROM students s
							JOIN modules m
							ON s.course_id = m.course_id
							JOIN courses c
							ON m.course_id = c.course_id
							WHERE s.student_id = '$stdId'
							AND m.level = s.status");
			     	$stmt->execute();
			     	foreach ($stmt as $key) {
			     		echo '<a href="module.php?mId='.$key['module_code'].'">'.$key['module_title'].'</a>';
			     	}
			     ?>
			    </div>
			 </div>
			<div class="dropdown">
			    <button class="dropbtn"><a>Schedules</a></button>
			    <div class="dropdown-content">
			      <a href="class-schedule.php">Class Schedule</a>
			      <a href="exam-schedule.php">Exam Schedule</a>
			    </div>
			 </div>
			<li><a href="notice.php">Notice</a></li>
			<li><a href="grades.php">Report</a></li>
			<li><a href="profile.php">Your Profile</a></li>
		</ul>
	</nav>