<?php
session_start();
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
          <a class="navbar-brand" href="index.php">NDEJJE UNIVERSITY HEALTH CENTER III</a>
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
          <button type="button" data-toggle="modal" data-target="#nurseModal" type="button" class="btn btn-primary btn-md">Add Patient's Details</button>
        </div>
        

        <div class="col-md-10">
            <div class="well well-md"><center>Logged in as Nurse</center></div>
        </div>
        
    </div>
    
    <div class="container">  
        <?php
            if( isset($_SESSION['nmessage'])): ?>

                <div class="alert alert-<?=$_SESSION['nmsg_type']?> alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php 
                echo $_SESSION['nmessage'];
                unset($_SESSION['nmessage'])
                          
               ?>
                </div>
                <?php endif; ?>

        <div class="panel panel-primary">
            <div class="panel-heading">Patient List</div>
            <div class="panel-body">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
          <thread>
            <tr>
                <th>Patient Number</th>
                <th>Name</th> 
                <th>Village</th>
                <th>Weight</th>
                <th>Height</th>
                <th>BloodPressure</th>
                <th>Temperature</th>
                <th>Status</th>
            </tr>
          </thread>
            <?php
            $result = $mysqli->query("SELECT *
              FROM Patient 
              INNER JOIN PatientDetails 
              ON Patient.PatientNo = PatientDetails.PatientNumber") or die($mysqli->error());
            if (mysqli_num_rows($result) != 0) {
             while ($row = $result->fetch_assoc()): 
            ?>
            <tr>
                <td><?php echo $row['PatientNo']; ?></td>
                <td><?php echo $row['Name']; ?></td>
                <td><?php echo $row['Village']; ?></td>
                <td><?php echo $row['Weight']; ?></td>
                <td><?php echo $row['Height']; ?></td>
                <td><?php echo $row['BloodPressure']; ?></td>
                <td><?php echo $row['Temperature']; ?></td>
                <td> 
                  <?php
                    $status = $row['Status'];
                    if ($status == 1) {
                      echo "<button type='button' class='btn btn-danger'> Not Diagnosed</button>";
                    }
                    elseif ($status == 0) {
                      echo "<button type='button' class='btn btn-success'>Diagnosed</button>";
                    }
                      
                  ?>
                </td>
              
            </tr>
          <?php  endwhile;
          } else {
           ?>
             <tr  >
                <td colspan=8>
                  <?php             
                     echo "<center> <h5><i> No patients found! </i></h5> </center> ";
                    }
                  ?>
                </td>
                
              </tr>
        </table>
   
            </div>
            <div class="panel-footer">&copy; 2019 &copy;</div>
        
      </div>
    </div>


    <!---------------------------------------
      MODALS
      ------------------------------->
      <!-- Nurse Modal -->
        <div class="modal fade" id="nurseModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->

                <div class="modal-content">
                    <div class="modal-header">
                        <div class="panel panel-primary ">
                            <div class="panel-heading">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Patient's Info</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="registerPatient.php">
                                <div class="form-group">
                                    <label for="nu">Nurse on Duty:</label>
                                    <input type="text" class="form-control" id="nu" placeholder="Enter Nurse Number" name="nurseId" value="<?php echo $_SESSION['name'] ?>" readonly required>
                                </div>

                                <div class="form-group">
                                    <label for="gender1">Patient Number:</label>
                                    <select class="form-control inputstl" name="patientNo" id="gender1">
                                        <?php 
                                      $result = $mysqli->query("SELECT * FROM Patient WHERE ToNurse = 0") or die($mysqli->error());
                                          if (mysqli_num_rows($result) != 0) {
                                           while ($row = mysqli_fetch_array($result)){ 
                                          echo '<option value="'.$row['PatientNo'].'">'.$row['PatientNo'].'</option>';
                                          }
                                        }
                                        else {
                                          echo '<option class="danger"> No new patients </option>';
                                        }
                                      ?>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="weight">Weight ( kilograms):</label>
                                    <input type="number" class="form-control" id="weight" placeholder="Enter weight" name="weight" pattern="[0-9]{1,}" title="Only numbers allowed" required>
                                </div>
                                <div class="form-group">
                                    <label for="height">Height ( meters):</label>
                                    <input type="number" class="form-control" id="height" name="height" placeholder="Enter height" pattern="[0-9]{1,}" title="Only numbers allowed" required>
                                </div>
                                <div class="form-group">
                                    <label for="pp">Blood Pressure (kg/cubic meter ):</label>
                                    <input type="number" class="form-control" id="pp" name="bloodPressure" placeholder="Enter Blood Pressure" pattern="[0-9]{1,}" title="Only numbers allowed" required>
                                </div>
                                <div class="form-group">
                                    <label for="tt">Temperature ( celsius):</label>
                                    <input type="number" class="form-control" id="tt" name="temperature" placeholder="Enter temperature" pattern="[0-9]{1,}" title="Only numbers allowed" required>
                                </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" name="saveDetails" class="btn btn-primary">Save</button>

                    </div>
                    </form>
                    <!--end form -->

                </div>

            </div>
        </div>

        </div>
        <!--end nurse modal-->
  </body>
  
</html>