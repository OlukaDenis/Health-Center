<?php

session_start();
$mysqli = new mysqli('localhost', 'root', '', 'healthcenter') or die(mysqli_error($mysqli));

$update = false;


	$id = 0;
	$patientNo = '';
	$name = '';
	$village = '';
	$date = '';
	$gender = '';
	$phone = '';



if (isset($_POST['save'])){
	$patientNo = $_POST['patientNo'];
	$name = $_POST['name'];
	$village = $_POST['village'];
	$date = $_POST['date'];
	$gender = $_POST['gender'];
	$phone = $_POST['phone'];

	// Check if user with that email already exists
		$result = $mysqli->query("SELECT * FROM Patient WHERE PatientNo ='$patientNo'") or die($mysqli->error());

		//if exists
		if ( $result->num_rows > 0 ) {
    
    	$_SESSION['message'] = 'Patient with the same patient number exists!';
    	$_SESSION['msg_type'] = 'danger';
   				 header("location: index.php");   
		}
		else{
			$mysqli->query("INSERT INTO Patient (PatientNo, Name, Village, DateOfBirth, Telephone, Sex, ToNurse) VALUES('$patientNo', '$name', '$village', '$date', '$phone', '$gender', 0)") or die($mysqli->error);

					$_SESSION['rmessage'] = "New patient has been recorded";
					$_SESSION['rmsg_type'] = 'success';
				
				header("location: reception.php");
		}	

}


if (isset($_POST['saveDetails'])){
	$nurseId = $_POST['nurseId'];
	$patientNo = $_POST['patientNo'];
	$weight = $_POST['weight'];
	$height = $_POST['height'];
	$bloodPressure = $_POST['bloodPressure'];
	$temperature = $_POST['temperature'];

	
		$mysqli->query("INSERT INTO PatientDetails (NurseNo, PatientNumber, Weight,  BloodPressure, Temperature, Height, Status) VALUES('$nurseId', '$patientNo', '$weight', '$bloodPressure', '$temperature', '$height', '1')") or die($mysqli->error);

				$_SESSION['nmessage'] = "Patient's information added";
				$_SESSION['nmsg_type'] = 'success';
				header("location: nurse.php");

		$mysqli->query("UPDATE Patient 
			SET ToNurse = 1  
			WHERE PatientNo='$patientNo'") or die($mysqli->error);
		

}
/*
if (isset($_GET['delete'])){
	$id = $_GET['delete'];
	$mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

	$_SESSION['message'] = "Info has been deleted!";
	$_SESSION['msg_type'] = "danger";

	header("location: landinfo.php");
}


if (isset($_GET['edit'])){
	$id = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
	if (count($result)==1){
		$row = $result->fetch_array();
		$country = $row['country'];
		$block = $row['block'];
		$plot= $row['plot'];
		$acreage = $row['acreage'];
		$location = $row['location'];
		$proprietor = $row['proprietor'];
		$incumbraces = $row['incumbraces'];
	}
}

if (isset($_POST['update'])){

$id = $_POST['id'];
$country = $_POST['country'];
	$block = $_POST['block'];
	$plot = $_POST['plot'];
	$acreage = $_POST['acreage'];
	$location = $_POST['location'];
	$proprietor = $_POST['proprietor'];
	$incumbraces = $_POST['incumbraces'];

$mysqli->query("UPDATE data SET country='$country', block='$block', plot='$plot', acreage='$acreage', location='$location', proprietor='$proprietor', incumbraces='$incumbraces' WHERE id=$id") or die($mysqli->error);

$_SESSION['message'] = "Info has been updated";
$_SESSION['msg_type'] = "warning";

header('location: landinfo.php');

}
*/

?>