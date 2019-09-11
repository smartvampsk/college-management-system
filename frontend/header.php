<!DOCTYPE html>
<html>
<head>
	<title> <?php echo $title; ?> </title>
	<link rel="stylesheet" type="text/css" href="../css/index.css">
	<script type="text/javascript" src="../js/index.js"></script>
</head>
<body>
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
				<button id="login"><a href="login.php">Login</a></button>
		</div>
	</header>
	<nav class="mainNav" id="mainNav">
		<ul>
			<li><a href="index.php">Home</a></li>
			<div class="dropdown">
			    <button class="dropbtn"><a href="aboutus.php">About WUC</a></button>
			    <div class="dropdown-content">
			      <a href="aboutus.php">Introduction</a>
			      <a href="#">Board of Directors</a>
			      <a href="#">Academic Team</a>
			      <a href="#">Management Team</a>
			      <a href="#">Our Infrastructure</a>
			      <a href="#">Academic Services</a>
			    </div>
			 </div>
			<div class="dropdown">
			    <button class="dropbtn"><a>Programme</a></button>
			    <div class="dropdown-content">
			      <?php 
			      require '../databaseConnection/connectdb.php';
			      	$cours = $pdo->prepare("SELECT * FROM courses");
			      	$cours->execute();
			      	foreach ($cours as $cour) {
			      		echo '<a href="#">'.$cour['course_title'].'</a>';
			      	}
			      ?>
			    </div>
			 </div>
			<li><a href="aboutus.php">About Us</a></li>
			<li><a href="aboutus.php">News</a></li>
			<li><a href="contactus.php">Contact</a></li>
		</ul>
	</nav>