<?php

session_start();
$mysqli = new mysqli('localhost', 'root', '', 'healthcenter');

if (isset($_POST['save'])){
	$doctorId = $_POST['doctorId'];
	$patientNo = $_POST['patientNo'];
	$diagnosis = $_POST['diagnosis'];
	$toLab = $_POST['toLab'];

		
		$query = "INSERT INTO DoctorDiagnosis (DoctorId, PatientNum, Diagnosis, ToLab) VALUES('$doctorId', '$patientNo', '$diagnosis', '$toLab')";
		$mysqli->query($query) or die($mysqli->error);
			$_SESSION['dmessage'] = $patientNo.' Patient diagnosis added';
			$_SESSION['dmsg_type'] = 'success';
			header("location: doctor.php");
			

		$update = "UPDATE PatientDetails SET Status = 0  WHERE PatientNumber='$patientNo'";
		$mysqli->query($update) or die($mysqli->error);

}

/*----------------------------------
	New patient lab results
--------------------------------------------*/
if (isset($_POST['saveResults'])){
	$labtechno = $_POST['labTechNo'];
	$doctorId = $_POST['doctorId'];
	$patientNo = $_POST['patientNo'];
	$results = $_POST['results'];

		
		$query = "INSERT INTO labtechnician (LabTechId, StuNum, DocNum, Results, ToDoc) VALUES('$labtechno', '$patientNo', '$doctorId', '$results', 1)";
		$mysqli->query($query) or die($mysqli->error);
			$_SESSION['lmessage'] = $patientNo.' Patient diagnosis added';
			$_SESSION['lmsg_type'] = 'success';
			header("location: labtech.php");
			

		$update = "UPDATE DoctorDiagnosis SET ToLab = 'No'  WHERE PatientNum='$patientNo'";
		$mysqli->query($update) or die($mysqli->error);

}


/*----------------------------------
	New patient lab results
--------------------------------------------*/
if (isset($_POST['billings'])){
	$patientNo = $_POST['patientNo'];
	$name = $_POST['name'];
	$diagnosis = $_POST['diagnosis'];
	$labfee = $_POST['labfee'];
	$consultationfee = $_POST['consultationfee'];
	$pharmacyfee = $_POST['pharmacyfee'];

		
		$query = "INSERT INTO accounts (PatientNumb, Name, Diagnosis, ConsultationFee, LabFee, PharmacyFee) VALUES('$patientNo', '$name', '$diagnosis', '$labfee', $consultationfee, $pharmacyfee)";
		$mysqli->query($query) or die($mysqli->error);
			$_SESSION['amessage'] = $patientNo.' Patient payment added';
			$_SESSION['amsg_type'] = 'success';
			header("location: accounts.php");
			

		$update = "UPDATE DoctorDiagnosis SET ToPharmacy = 1, ToAccounts = 0  WHERE PatientNum='$patientNo'";
		$mysqli->query($update) or die($mysqli->error);

		$update = "UPDATE accounts SET Paid = 1  WHERE PatientNumb='$patientNo'";
		$mysqli->query($update) or die($mysqli->error);

}

/*----------------------------------------
	Update diagnosis info
--------------------------------------------*/

if (isset($_POST['updateDiagnosis'])){
	$doctorId = $_POST['doctorId'];
	$patientNo = $_POST['patientNo'];
	$diagnosis = $_POST['diagnosis'];

		
		$query = "UPDATE DoctorDiagnosis SET 
					DoctorId = '$doctorId', 
					PatientNum = '$patientNo', 
					Diagnosis = '$diagnosis', 
					ToAccounts = 1
					WHERE PatientNum = '$patientNo'";
		$mysqli->query($query) or die($mysqli->error);
			$_SESSION['dmessage'] = $patientNo.' Patient diagnosis updated';
			$_SESSION['dmsg_type'] = 'success';
			header("location: doctor.php");
		
		$update = "UPDATE labtechnician SET ToDoc = 0 WHERE StuNum='$patientNo'";
		$mysqli->query($update) or die($mysqli->error);

}

/*------------------------------
	Pahrmacy medication 
	----------------------------*/
if (isset($_POST['medication'])){
	$patientNo = $_POST['patientNo'];
	$name = $_POST['name'];
	$medication = $_POST['medication'];

		
		$query = "INSERT INTO pharmacy (StudntNum, Name, Medication) VALUES('$patientNo', '$name', '$medication')";
		$mysqli->query($query) or die($mysqli->error);
			$_SESSION['pmessage'] = ' Patient medication added';
			$_SESSION['pmsg_type'] = 'success';
			header("location: pharmacy.php");
		
		$update = "UPDATE doctordiagnosis SET ToPharmacy = 0 WHERE PatientNum='$patientNo'";
		$mysqli->query($update) or die($mysqli->error);

}


/*=====================================================================
	Employee Login
==============================================================*/

/*------------------
Reception
-----------------*/

if (isset($_POST['receptionLogin'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

		
		$query = "SELECT * FROM employees WHERE username = '$username' AND password = '$password' AND role ='receptionist'";
		$result = $mysqli->query($query);
		if ($result->num_rows > 0) {
               while ($row = $result->fetch_assoc()){
               		$_SESSION['name'] = $row['name'];
               		// This is how we'll know the user is logged in
        			$_SESSION['logged_in'] = true;
               		header("location: reception.php");
               }
          }
          else{
          	$_SESSION['message'] = ' Wrong username or Password';
          	$_SESSION['msg_type'] = 'danger';
          	header("location: index.php");
          }
}


/*------------------
Nurse
-----------------*/

if (isset($_POST['nurseLogin'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

		
		$query = "SELECT * FROM employees WHERE username = '$username' AND password = '$password' AND role ='nurse'";
		$result = $mysqli->query($query);
		if ($result->num_rows > 0) {
               while ($row = $result->fetch_assoc()){
               		$_SESSION['name'] = $row['name'];
               		header("location: nurse.php");
               }
          }
          else{
          	$_SESSION['message'] = ' Wrong username or Password';
          	$_SESSION['msg_type'] = 'danger';
          	header("location: index.php");
          }

}

/*------------------
Doctor
-----------------*/

if (isset($_POST['doctorLogin'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

		
		$query = "SELECT * FROM employees WHERE username = '$username' AND password = '$password' AND role ='doctor'";
		$result = $mysqli->query($query);
		if ($result->num_rows > 0) {
               while ($row = $result->fetch_assoc()){
               		$_SESSION['name'] = $row['name'];
               		header("location: doctor.php");
               }
          }
          else{
          	$_SESSION['message'] = ' Wrong username or Password';
          	$_SESSION['msg_type'] = 'danger';
          	header("location: index.php");
          }

}

/*------------------
Lab Technician
-----------------*/

if (isset($_POST['labLogin'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

		
		$query = "SELECT * FROM employees WHERE username = '$username' AND password = '$password' AND role ='lab technician'";
		$result = $mysqli->query($query);
		if ($result->num_rows > 0) {
               while ($row = $result->fetch_assoc()){
               		$_SESSION['name'] = $row['name'];
               		header("location: labtech.php");
               }
          }
          else{
          	$_SESSION['message'] = ' Wrong username or Password';
          	$_SESSION['msg_type'] = 'danger';
          	header("location: index.php");
          }

}


/*------------------
Accounts
-----------------*/

if (isset($_POST['accountsLogin'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

		
		$query = "SELECT * FROM employees WHERE username = '$username' AND password = '$password' AND role ='accountant'";
		$result = $mysqli->query($query);
		if ($result->num_rows > 0) {
               while ($row = $result->fetch_assoc()){
               		$_SESSION['name'] = $row['name'];
               		header("location: accounts.php");
               }
          }
          else{
          	$_SESSION['message'] = ' Wrong username or Password';
          	$_SESSION['msg_type'] = 'danger';
          	header("location: index.php");
          }

}

/*------------------
Pharmacy
-----------------*/

if (isset($_POST['pharmacyLogin'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

		
		$query = "SELECT * FROM employees WHERE username = '$username' AND password = '$password' AND role ='pharmacist'";
		$result = $mysqli->query($query);
		if ($result->num_rows > 0) {
               while ($row = $result->fetch_assoc()){
               		$_SESSION['name'] = $row['name'];
               		header("location: pharmacy.php");
               }
          }
          else{
          	$_SESSION['message'] = ' Wrong username or Password';
          	$_SESSION['msg_type'] = 'danger';
          	header("location: index.php");
          }

}


?>