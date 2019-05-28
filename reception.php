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
   
   <!------------------
    Online
    ------------------------>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
           <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
 
 
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
          <button type="button" data-toggle="modal" data-target="#receptionistModal" type="button" class="btn btn-primary btn-md">Add Patient</button>
        </div>
        

        <div class="col-md-10">
            <div class="well well-md"><center>Logged in as Receptionist</center></div>
        </div>
        
    </div>

    <div class="container">    
        <?php
          // Check if user is logged in using the session variable
          if ( $_SESSION['logged_in'] != 1 ) {
            $_SESSION['message'] = "You must log in first!";
            $_SESSION['msg_type'] = "danger";
            header("location: index.php");    
          }else{
            if( isset($_SESSION['rmessage'])):          
        ?>

                <div class="alert alert-<?=$_SESSION['rmsg_type']?> alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php 
                echo $_SESSION['rmessage'];
                unset($_SESSION['rmessage'])
                          
               ?>
                </div>
                <?php                
              endif;
              } ?>


        <div class="panel panel-primary">
            <div class="panel-heading">Patient List</div>
            <div class="panel-body">
            <table class="table table-bordered table-hover" id="patientList" width="100%" cellspacing="0">
                <thread>
                  <tr>
                      <th>No.</th>
                      <th>Patient Number</th>
                      <th>Name</th> 
                      <th>Village</th>
                      <th>Date of Birth</th>
                      <th>Contact</th>
                      <th>Gender</th>
                      <th>Nurse Status</th>
                  </tr>
                </thread>
                  <?php
                  $result = $mysqli->query("SELECT * FROM Patient ") or die($mysqli->error());
                  if (mysqli_num_rows($result) != 0) {
                    $count = 1;
                   while ($row = mysqli_fetch_array($result)): 
                    /*$mysql_data[] = array(
                      "patient_number" => $row['PatientNo'],
                      "name" => $row['Name'],
                      "village" => $row['Village'],
                      "date_of_birth" => $row['DateOfBirth'],
                      "telephone" => $row['Telephone'],
                      "gender" => $row['Sex']
                      );*/
                  ?>
                  <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo $row['PatientNo']; ?></td>
                      <td><?php echo $row['Name']; ?></td>
                      <td><?php echo $row['Village']; ?></td>
                      <td><?php echo $row['DateOfBirth']; ?></td>
                      <td><?php echo $row['Telephone']; ?></td>
                      <td><?php echo $row['Sex']; ?></td>
                      <td> 
                        <?php
                        $status = $row['ToNurse'];
                          if ($status == 0) {
                            echo "<button type='button' class='btn btn-danger'> Not Seen</button>";
                          }
                          elseif ($status == 1) {
                            echo "<button type='button' class='btn btn-success'>Seen</button>";
                           }
                        ?>
                      </td>
                    
                  </tr>
                <?php  
                    $count++;
                  endwhile;                  
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

              <?php
                // Convert PHP array to JSON array
                  //$json_data = json_encode($mysql_data);
                  //print $json_data;
              ?>
              </div> 
            </table>
             
            </div>
            <div class="panel-footer">&copy; 2019 &copy;
         </div>
        
      
    </div>

    <!-----------------------------------------------------
      Modals
      ----------------------------------------------------------->

      <!-- Receptionist Modal -->
        <div class="modal fade" id="receptionistModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->

                <div class="modal-content">
                    <div class="modal-header">
                        <div class="panel panel-primary ">
                            <div class="panel-heading">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Add Patient</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="modal-body">
                                <form method="post" action="registerPatient.php" name="create">
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Patient name" pattern="[A-Za-z]{1,} [A-Za-z]{1,}" title="Only letters are allowed"  required >
                                    </div>
                                    <div class="form-group">
                                        <label for="patientNo">Patient number:</label>
                                        <input type="text" class="form-control" name="patientNo" id="patientNo" placeholder="Patient number:" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="village">Village:</label>
                                        <input type="text" class="form-control" name="village" id="village" pattern="[A-Za-z]{2,}" title="Only letters are allowed" placeholder="Village" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="date">Date of Birth:</label>
                                        <input type="date" class="form-control" name="date" id="date" placeholder="Date of Birth" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender1">Gender:</label>
                                        <select class="form-control inputstl" name="gender" id="gender1">
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Telephone:</label>
                                        <input type="number" class="form-control" name="phone" id="phone" placeholder="Telephone" required>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" class="btn btn-primary">Save</button>

                    </div>
                    </form>
                    <!--end form -->

                </div>

            </div>
        </div>

        </div>
        <!--end receptionist modal-->
  </body>
</html>
  <script>
    $(document).ready(function(){
        $('#patientList').DataTable();
    });
  </script>
  

