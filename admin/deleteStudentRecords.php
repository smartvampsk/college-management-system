<?php  
session_start();
	include 'sessionNotSet/sessionNotSet.php';
include 'databaseConnection/connectdb.php';
	if(isset($_GET['s_id'])){
		$stmt = $pdo->prepare("DELETE FROM students WHERE student_id = :s_id");
		$result = $stmt->execute($_GET);
		if($result == true){
			header('location:studentManagement.php?');
		}
		else{
			echo "Record not deleted";
		}
	}
?>