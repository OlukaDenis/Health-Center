<?php

session_start();
$mysqli = new mysqli('localhost', 'root', '', 'healthcenter') or die(mysqli_error($mysqli));

	

	// Pick all new added patients

if (isset($_GET['approve'])){
	$id = $_GET['approve'];
	$result = $mysqli->query("SELECT * FROM patient WHERE id = $id") or die($mysqli->error());
	if (count($result)==1){
		$row = $result->fetch_array();
		$id = $row['id'];
		$_SESSION['current_id'] = $row['id'];
		header("location: doctor.php");
		//$name = $row['Name'];

	}	
}


if (isset($_GET['test'])){
	$doctorId = $_GET['test'];
	$result = $mysqli->query("SELECT * FROM DoctorDiagnosis WHERE DoctorId = $doctorId") or die($mysqli->error());
	if (count($result)==1){
		$row = $result->fetch_array();
		$doctorId = $row['DoctorId'];
		//$name = $row['Name'];

	}	
}


?>