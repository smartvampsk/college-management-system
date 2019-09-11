<?php
	require 'header.php';
	if (isset($_GET['mId'])) {
		$_SESSION['mId'] = $_GET['mId'];
		$mId = $_SESSION['mId'];
	}
?>
<section class="modules-section">
	<div class="modules-section-left">
		<nav>
			<ul>
				<?php
					$mod = $pdo->prepare("SELECT * FROM modules WHERE module_code = '$mId'");
					$mod->execute();
					foreach ($mod as $row) {
						echo '<h4><u>'.$row['module_title'].'</u></h4>';
						echo '<li><a href="module.php?mId='.$mId.'">Welcome</a></li>';
						echo '<li><a href="module.php?sId='.$mId.'">Slides</a></li>';
						echo '<li><a href="module.php?aId='.$mId.'">Assessment</a></li>';
						echo '<li><a href="module.php?cId='.$mId.'">Contact</a></li>';
						echo '<li><a href="module.php?swId='.$mId.'">View Submitted Work</a></li>';
					}
				?>
			</ul>
		</nav>
	</div>
	<div class="modules-section-right">