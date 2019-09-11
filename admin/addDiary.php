<?php
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';

	if (isset($_POST['submit'])) 
	{
		if (empty($_POST['title'])) 
		{
			echo "Title cannot be empty";
		}
		else if (empty($_POST['dtext'])) 
		{
			echo "Text cannot be empty";
		}
		else
		{
			$title = $_POST['title'];
			$text = $_POST['dtext'];
			$date = $_POST['dateofwork'];

			$dataInserter = $pdo -> prepare("INSERT INTO diarymanagement(adate,title,dateofwork,dtext)
				VALUES(:adate,:title,:dateofwork,:dtext)");
			$valueGiver = [
				'adate' =>  date("Y-m-d"),
				'title' => $title,
				'dateofwork' => $date,
				'dtext' => $text
			];
			$dataInserter -> execute($valueGiver);
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
		<h2>Add Dates</h2>
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
				<form action="" method="POST">

					<label>To do Work: </label><br><br>
					<input type="text" name="title"><br><br>

					<label>Date </label>
					<input type="Date" name="dateofwork"><br><br>

					<label>To do description: </label><br><br>
					<input type="text" name="dtext"><br><br>

					<input type="submit" name="submit" value="Submit">
				</form>
			</article>
		</section>
	</main>
	<footer>
		<?php require 'footer.php';  ?>
	</footer>
</body>
</html>