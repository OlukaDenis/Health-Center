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

  <!--------------------------
    Datatable
    ---------------------------->

    <div class="container">

        <div class="col-md-2">
         <!-- <button type="button" data-toggle="modal" data-target="#nurseModal" type="button" class="btn btn-primary btn-md">Add Patient's Details</button>-->
        </div>
        

        <div class="col-md-10">
            <div class="well well-md"><center>Logged in as Doctor</center></div>
        </div>
        
    </div>

    <div class="container">

      <?php
            if( isset($_SESSION['dmessage'])): ?>

                <div class="alert alert-<?=$_SESSION['dmsg_type']?> alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php 
                echo $_SESSION['dmessage'];
                unset($_SESSION['dmessage'])
               ?>
                </div>
                <?php endif; ?>
      
      <div class="col-md-12">

        <div class="panel panel-primary">
          <div class="panel-heading">New Patients</div>
          <div class="panel-body">
          
            
             <!-----------------------
              table 2
              --------------------------->
            <div >
                  <h5>From the Nurse: </h5>
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thread>
                    <tr>
                        <th>No.</th>
                        <th>Patient Number</th>
                        <th>Name</th> 
                        <th>Blood Pressure</th> 
                        <th>Temperature</th> 
                        <th colspan="2">Action</th>
                    </tr>
                  </thread>
                    <?php
                    $result = $mysqli->query("SELECT * FROM PatientDetails
                    INNER JOIN Patient
                    ON Patient.PatientNo = PatientDetails.PatientNumber
                    WHERE Status = 1") or die($mysqli->error());
                    if (mysqli_num_rows($result) > 0) {                
                    $count = 1;
                    while ($row = $result->fetch_array()): 
                    ?>
                    <tr data-row="id_from_db">
                        <td name=""><?php echo $row['id']; ?></td>
                        <td><?php echo $row['PatientNo']; ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['BloodPressure']; ?></td>
                        <td><?php echo $row['Temperature']; ?></td>
                        <td>
                          <a href="getNewPatient.php?approve=<?php echo $row['id']; ?>">  <a class="btn btn-danger" data-toggle="modal" data-target="#approvalModal" >Diagnose</a> </a>
                          <?php //echo $row['PatientNo']; ?>
                          <?php $currentPatient = $row['PatientNo'];?>                  
                        </td>
                      <?php 
                          $count++;
                        endwhile;                     
                      } else {
                       ?>
                    </tr>
                    <tr  >
                      <td colspan=6>
                        <?php             
                           echo "<center> <h5><i> No patients found! </i></h5> </center> ";
                          }
                        ?>
                      </td>
                      
                    </tr>
                    
                </table>
            </div>
                
            <!-----------------------
              table 1
              --------------------------->
            <div style="margin-top: 20px;">
                 <h4>From the Lab Technician</h4>
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thread>
                    <tr>
                        <th>No.</th>
                        <th>Patient Number</th>
                        <th>Name</th> 
                        <th>Diagnosis</th> 
                        <th>LabTech Number</th> 
                        <th>Results</th> 
                        <th colspan="2">Action</th>
                    </tr>
                  </thread>
                    <?php
                    $result = $mysqli->query("SELECT * FROM labtechnician
                    INNER JOIN Patient
                    ON Patient.PatientNo = labtechnician.StuNum
                    INNER JOIN doctordiagnosis
                    ON labtechnician.DocNum = doctordiagnosis.DoctorId
                    WHERE ToDoc = 1") or die($mysqli->error());
                    if (mysqli_num_rows($result) != 0) {                
                    $count = 1;
                    while ($row = $result->fetch_assoc()): 
                    ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $row['PatientNo']; ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['Diagnosis']; ?></td>
                        <td><?php echo $row['LabTechId']; ?></td>
                        <td><?php echo $row['Results']; ?></td>

                        <td>
                          <a href="getNewPatient.php?approve=<?php echo $row['PatientNo']; ?>">  <a class="btn btn-warning" data-toggle="modal" data-target="#diagnoseFromLab" >Re-Diagnose</a> </a>
                          <?php //echo $row['PatientNo']; ?>
                          <?php $currentPatient = $row['PatientNo'];
                          $currentDiagnosis = $row['Diagnosis'];?>                  
                        </td>
                      <?php 
                          $count++;
                        endwhile;                     
                      } else {
                       ?>
                    </tr>
                    <tr  >
                      <td colspan=7>
                        <?php             
                           echo "<center> <h5><i> No patients found! </i></h5> </center> ";
                          }
                        ?>
                      </td>
                      
                    </tr>
                </table>
                
            </div>    

          </div>
          <div class="panel-footer">&copy; 2019 &copy;</div>
        </div>
        
      </div>
    </div>

    <!----------------------------------------------
         Modals
      ----------------------------------------------->

    <!-- diagnosis modal -->
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
                                  <label for="name">Doctor on Duty</label>
                                  <input type="text" class="form-control" name="doctorId" id="name" placeholder="Doctor Number" value="<?php echo $_SESSION['name'] ?>" readonly  required>
                                </div>
                                <div class="form-group">
                                  <label for="patientNo">Patient number:</label>
                                  <input type="text" class="form-control" name="patientNo" id="patientNo" placeholder="Patient number:" value="<?php echo $currentPatient; ?>" readonly  required>
                                </div>
                                <div class="form-group">
                                  <label for="village">Patient diagnosis:</label>
                                  <textarea class="form-control" rows="5" id="village"  placeholder="Diagnosis" name="diagnosis" name="medication" pattern=".{2,}" title="Atleast two letters required"></textarea>
                                </div>
                                
                                 <div class="form-group">
                                  <label for="send">Send to the Lab:</label>
                                    <select class="form-control inputstl" name="toLab" id="send">
                                      <option>Yes</option>
                                      <option>No</option>
                                    </select>          
                                    
                                  </div>                                
                       </div>
                      </div>
                  </div>                    
                    
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
                       <button type="submit" name="save" class="btn btn-primary">Save</button>
                      
                    </div>
                  </form><!--end form -->

                  </div>
                  
                </div>
              </div>
              
            </div>
        <!--end receptionist modal--> 

        <!-- diagnosis from the lab modal -->
              <div class="modal fade" id="diagnoseFromLab" role="dialog">
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
                      <?php 
                            $result = $mysqli->query("SELECT * FROM doctordiagnosis WHERE PatientNum = '$currentPatient'") or die($mysqli->error());
                                if (mysqli_num_rows($result) != 0) {
                                 while ($row = mysqli_fetch_array($result)){ 
                          ?>
                      <div class="panel-body">
                          <div class="modal-body">
                              <form method="post" action="dboperations.php" name="create">
                                <div class="form-group">
                                  <label for="name">Doctor Number</label>
                                  <input type="text" class="form-control" name="doctorId" value="<?php echo $row['DoctorId'] ?>" id="name" placeholder="Doctor Number" value="<?php echo $_SESSION['name'] ?>" readonly required>
                                </div>
                                <div class="form-group">
                                  <label for="patientNo">Patient number:</label>
                                  <input type="text" class="form-control" name="patientNo" id="patientNo" placeholder="Patient number:" value="<?php echo $currentPatient ?>" readonly required>
                                </div>
                                <div class="form-group">
                                  <label for="village">Patient diagnosis:</label>
                                  <textarea class="form-control" rows="5" id="village" placeholder="Diagnosis" name="diagnosis" name="medication" pattern=".{2,}" title="Atleast two letters required"><?php echo $row['Diagnosis'] ?></textarea>
                                </div>
                                <?php
                                        }
                                      }
                                  ?>                       
                       </div>
                      </div>
                  </div>                    
                    
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
                       <button type="submit" name="updateDiagnosis" class="btn btn-primary">Update</button>
                      
                    </div>
                  </form><!--end form -->

                  </div>
                  
                </div>
              </div>
              
            </div>
        <!--end receptionist modal-->   
     

</body>

</html>
