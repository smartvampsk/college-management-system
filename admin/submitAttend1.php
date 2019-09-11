<?php 
	session_start();
	include 'sessionNotSet/sessionNotSet.php';
	include 'databaseConnection/connectdb.php';
	$todayDate = Date("Y-m-d");
	if (isset($_POST['submitRadio'])) {
		$attendInsert = $pdo->prepare("INSERT INTO attendance(attendance_id, status, student_id, module_id, currentDate)
			VALUES('', :status, :s_id, :module_id, :currentDate)");
		$criteriaInsert = [
			'status'=>$_POST['present'],
			's_id'=>$_POST['s_id'],
			'module_id'=>$_POST['module_id'],
			'currentDate'=>$todayDate
		];
		$success = $attendInsert->execute($criteriaInsert);
		if($success)
			header('location:attendance-sheet1.php');
		else
			echo "Sorry";
	}
?>