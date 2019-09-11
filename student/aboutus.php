<?php 
	$title = "WUC - About us";
	session_start();
	if (!isset($_SESSION['stdId'])) {
		header('location:../frontend/login.php');
	}
	require 'header.php';
?>

<section class="aboutus-Section">
	<div class="aboutrow1">
		<h3>Overview</h3>
		<p>Woodlands University College (WUC) is a small Higher Education institution offering a wide range of degree courses.</p>
	</div>
	<div class="aboutrow2">
		<h3>Goals And Objectives</h3>
		<p>Our objective is: </p>
		<p>Our objective is: </p>
		<p>Our objective is: </p>
		<p>Our objective is: </p>
		<p>Our objective is: </p>
		
	</div>
	<div class="aboutrow3">
		<h3>Achivements</h3>
		<p>Our achivement is: </p>
		<p>Our achivement is: </p>
		<p>Our achivement is: </p>
		<p>Our achivement is: </p>
		<p>Our achivement is: </p>
	</div>
</section>

<?php  
	require 'footer.php';
?>