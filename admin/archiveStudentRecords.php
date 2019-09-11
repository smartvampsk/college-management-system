<?php  
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	if(isset($_GET['s_id'])){
		$s_id = $_GET['s_id'];
		$stmt = $pdo->query("UPDATE students
								SET archive = 0
								WHERE student_id = '$s_id'");
		$result = $stmt->execute($_GET);
		if($result == true){
			header('location:studentManagement.php');
		}
		else{
			echo "Not archived";
		}
	}
?>