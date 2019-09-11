<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';

	if (isset($_GET['announcementid'])) 
	{

		$aid = $_GET['announcementid'];

		$executerVar = $pdo -> prepare("SELECT * FROM diarymanagement WHERE id = :announcementid");
		$dataGiver = [
			'announcementid' => $aid
		];
		$executerVar -> execute($dataGiver);
		$recordGiver = $executerVar -> fetch();

		if (isset($_POST['update']))
		{
		 	if (empty($_POST['title'])) 
		 	{
		 		header('location:Announcement.php?updatedText=Title cannot be empty.&&ann=2');
		 	}
		 	else if (empty($_POST['dtext'])) 
		 	{
		 		header('location:Announcement.php?updatedText=Text cannot be empty.&&ann=2');
		 	}
		 	else
		 	{
		 		$updaterVar = $pdo -> prepare ("UPDATE diarymanagement SET 
		 		adate = :adate,
				title = :title,
				dateofwork = :dateofwork,
				dtext = :dtext
				WHERE 
				id = :did ");
				unset($_POST['update']);
				$finalUpate = $updaterVar -> execute($_POST);
		 	}
		}
	}
?>



<!DOCTYPE html>
<html>
<head>
	<title>
		HomePage
	</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<header>
		<?php require 'header.php';  ?>
	</header>
	<div class="menubar">
		<h2>Dairy</h2>
	</div>
	<div class="navbar">
		<nav>
			<ul>
				<li><a href="addDiary.php"> Add Details</a></li>
				<li><a href="editDiary.php"> Edit Details</a></li>
				<li><a href="prompt.php"> Prompt </a></li>
			</ul>
		</nav>
	</div>
	<main>
		<?php require 'sidebar.php'; ?>
		<section>
			<article class="addForm">
				<form method="POST" action="">
					<?php 
						$getData = $pdo -> prepare("SELECT * from diarymanagement");
						$getData->execute();

						foreach ($getData as $storedValue) 
						{
							echo '<li>' .$storedValue['title']. '<a href = "editDiary.php?announcementid='.$storedValue['id'].'"> Edit</a> </li>';
						}
					?>
					<br><br>
					<h3>Edit Your Diary</h3>
					<input type="hidden" name="did"  value="<?php echo $aid?>">
					<input type="hidden" name="adate" value="<?php echo date("Y-m-d") ?>">

					<label>To do Work: </label><br><br>
					<input type="text" name="title" value="<?php if(isset($recordGiver['title'])) echo $recordGiver['title'] ?>"><br><br>

					<label>Date </label>
					<input type="Date" name="dateofwork" value="<?php if(isset($recordGiver['dateofwork'])) echo $recordGiver['dateofwork'] ?>"><br><br>

					<label>To do description: </label><br><br>
					<textarea name="dtext"><?php if(isset($recordGiver['dtext'])) echo $recordGiver['dtext'] ?></textarea><br><br>
					
					<input type="submit" name="update" value="Update">	
				</form>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>