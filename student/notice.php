<?php 
	$title = "WUC - Notice";
	session_start();
	if (!isset($_SESSION['stdId'])) {
		header('location:../frontend/login.php');
	}
	require 'header.php';
?>
<section>
	<div class="notice-section">
		<h2>Examination Time and Date Fixed</h2>
		<p>Your exam is fixalhlgkelwajk khghsulikjw fnhheakyu flijkhkaeryiuf lhjhwiaygdkuf hjhaeyulfh hiEKULFH </p>
		<a href="exam-schedule.php" style="padding-left: 25px;">view exam schedule...</a>
		<br><br><hr>
		<h2>Lorem Ipsum Dolor</h2>
		<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet 	dolore magna aliquam erat volutpat.</p>
		<p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p><br><br><hr>
		<h2>Lorem Ipsum</h2>
		<p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
		<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet 	dolore magna aliquam erat volutpat.</p>
		<br><br><hr>
		<h2>Examination Time and Date Fixed</h2>
		<p>Your exam is fixalhlgkelwajk khghsulikjw fnhheakyu flijkhkaeryiuf lhjhwiaygdkuf hjhaeyulfh hiEKULFH </p><br><br>
	</div>

</section>

<?php 
	require 'footer.php';
?>