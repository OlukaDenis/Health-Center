<?php
  require_once('getNewPatient.php');
  $mysqli = new mysqli('localhost', 'root', '', 'healthcenter') or die(mysqli_error($mysqli));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ndejje health center</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css">
   <script src="js/bootstrap.min.js"></script>
   <script src="js/jquery.min.js"></script>  
   <script src="js/bootstrap1.min.js"></script>
        <script src="js/jquery1.min.js"></script> 
   <script src="js/jquery.dataTables.min.js"></script>  
   <script src="js/dataTables.bootstrap.min.js"></script>
   <link rel="stylesheet" href="css/dataTables.bootstrap.min.css" /> 
  
</head>
<body>

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
       
      <div class="navbar-header">
        <a class="navbar-brand" href="#">NDEJJE UNIVERSITY HEALTH CENTER III</a>     
      </div>
      <ul class="nav navbar-nav">
          <li class="active" ><a href="index.php">Home</a></li> 
        </ul>
         <ul class="nav navbar-nav navbar-right">
          
        <li class="active" ><a href=""><?php echo $_SESSION['name']; ?></a></li>
        <li  ><a href="logout.php">Logout</a></li>
        </ul>
    </div>
  </nav>

  
    <div class="container">

        <div class="col-md-2">
         <!-- <button type="button" data-toggle="modal" data-target="#nurseModal" type="button" class="btn btn-primary btn-md">Add Patient's Details</button>-->
        </div>
        

        <div class="col-md-10">
            <div class="well well-md"><center>Logged in as Lab Technician</center></div>
        </div>
        
    </div>

    <!--------------------------
    Datatable
    ---------------------------->

    <div class="container">

      <?php
            if( isset($_SESSION['lmessage'])): ?>

                <div class="alert alert-<?=$_SESSION['lmsg_type']?> alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php 
                echo $_SESSION['lmessage'];
                unset($_SESSION['lmessage'])
                          
               ?>
                </div>
                <?php endif; ?>
      
      <div class="col-md-12">

        <div class="panel panel-primary">
          <div class="panel-heading">New Laboratory Requests</div>
          <div class="panel-body">
            
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
              <thread>
                <tr>
                    <th>Patient Number</th>
                    <th>Doctor on Duty </th>
                    <th>Name</th> 
                    <th>Diagnosis</th>
                    <th colspan="2">Action</th>
                </tr>
              </thread>
                <?php
                $result = $mysqli->query("SELECT * FROM DoctorDiagnosis
                INNER JOIN Patient
                ON Patient.PatientNo = DoctorDiagnosis.PatientNum
                WHERE ToLab = 'Yes'") or die($mysqli->error());
                if (mysqli_num_rows($result) != 0) {
                while ($row = $result->fetch_assoc()): 
                ?>
                <tr>
                    <td><?php echo $row['PatientNo']; ?></td>
                    <td><?php echo $row['DoctorId']; ?></td>
                    <td><?php echo $row['Name']; ?></td>
                    <td><?php echo $row['Diagnosis']; ?></td>
                    <td>
                      <a href="getNewPatient.php?test=<?php echo $row['DoctorId']; ?>">  <a class="btn btn-danger" data-toggle="modal" data-target="#approvalModal" >Run Test</a> </a>
                      <?php //echo $row['DoctorId']; ?>
                      <?php //$currentDoc = $row['DoctorId'];
                      $currentPatientNo = $row['PatientNo']; ?>                     
                    </td>
                </tr>
              <?php  endwhile;
              } else { ?>
                <div class="alert alert-warning">
              <?php                  
                  echo "<center> <h4> No new patients found! </h4> </center> ";
                }
              ?>
          </div>
           </table>
           
          
        </div>
        <div class="panel-footer">&copy; 2019 &copy;</div>
      </div>
    </div>

    <!----------------------------------------------
         Modals
      ----------------------------------------------->

    <!--lab Modal -->
              <div class="modal fade" id="approvalModal" role="dialog">
                <div class="modal-dialog">
                
                    
                     
                  <!-- Modal content-->

                  <div class="modal-content">
                    <div class="modal-header" >
                      <div class="panel panel-primary ">
                          <div class="panel-heading">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Diagonise patient</h4>
                        </div>
                      </div>
                      <div class="panel-body">
                          <div class="modal-body">
                              <form method="post" action="dboperations.php" name="create">
                                <div class="form-group">
                                  <label for="name">Lab Technician on Duty</label>
                                  <input type="text" class="form-control" name="labTechNo" id="name" placeholder="Lab Tech Number" value="<?php echo $_SESSION['name'] ?>" readonly required>
                                </div>
                                <div class="form-group">
                                  <label for="patientNo">Patient number:</label>
                                  <input type="text" class="form-control" name="patientNo" id="patientNo" placeholder="Patient number:" value="<?php echo $currentPatientNo ?>" required readonly>
                                </div>
                                <?php 
                                    $result = $mysqli->query("SELECT * FROM doctordiagnosis WHERE PatientNum = '$currentPatientNo'") or die($mysqli->error());
                                        if (mysqli_num_rows($result) != 0) {
                                         while ($row = mysqli_fetch_array($result)){ 
                                  ?>
                                <div class="form-group">
                                  <label for="name">Doctor Number</label>
                                  <input type="text" class="form-control" name="doctorId" id="name" placeholder="Doctor Number" value="<?php echo $row['DoctorId'] ?>" required readonly>
                                </div>
                                <?php
                                        }
                                      }
                                  ?>
                                
                                <div class="form-group">
                                  <label for="diag">Tests Results:</label>
                                  <textarea class="form-control" rows="4" id="diag" placeholder="Results" name="results" name="medication" pattern=".{2,}" title="Atleast two letters required"></textarea>
                                </div>
                                                                
                       </div>
                      </div>
                  </div>                    
                    
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
                       <button type="submit" name="saveResults" class="btn btn-primary">Save</button>
                      
                    </div>
                  </form><!--end form -->

                  </div>
                  
                </div>
              </div>
              
            </div>
        <!--end receptionist modal-->   
     

</body>
</html>


