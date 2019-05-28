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
                <a class="navbar-brand" href="#">NDEJJE UNIVERSITY HEALTH CENTER III</a>
                <div class="navbar-header">
                    <center>
                    </center>
                </div>

            </div>
        </nav>

        <div class="container">

            <?php
            if( isset($_SESSION['message'])): ?>

                <div class="alert alert-<?=$_SESSION['msg_type']?> alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message'])
                          
               ?>
                </div>
                <?php endif; ?>

                    <div id="staff-div" class="col-md-4 ">
                        <div id="staff" class="card">
                            <div class="card-head">
                                <h4>Receptionist</h4>
                            </div>
                            <img class="card-img-top" src="images/receptionist.png" alt="Card image cap" style="width: 88px; height: 88px;">
                            <div class="card-body " style="margin-top: 10px;">
                                <p class="card-text">Register new patients</p>

                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#receptionistLogin" style="width: 50%; margin-top: 20px;">Login</button>
                                
                            </div>
                        </div>
                    </div>

                    <div id="staff-div" class="col-md-4">
                        <div id="staff" class="card ">
                            <div class="card-head">
                                <h4>Nurse</h4>
                            </div>
                            <img class="card-img-top" src="images/nurse.png" alt="Card image cap" style="width: 88px; height: 88px;">
                            <div class="card-body " style="margin-top: 10px;">
                                <p class="card-text">Registers more details for the patients.</p>

                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nurseLogin" style="width: 50%; margin-top: 20px;"> Login</button>
                                
                            </div>
                        </div>
                    </div>

                    <div id="staff-div" class="col-md-4">
                        <div id="staff" class="card ">
                            <div class="card-head">
                                <h4>Doctor</h4>
                                <img class="card-img-top" src="images/doctor.png" alt="Card image cap" style="width: 88px; height: 88px;">
                            </div>

                            <div class="card-body " style="margin-top: 10px;">
                                <p class="card-text">Diagnoses new patients and sends them for lab checkups.</p>

                            </div>
                            <div class="card-footer">
                                
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#doctorLogin" style="width: 50%; margin-top: 20px;"> Login </button>
                                
                            </div>
                        </div>
                    </div>

        </div>

        <div class="container" style="margin-top: 50px;">

            <div id="staff-div" class="col-md-4 ">
                <div id="staff" class="card ">
                    <div class="card-head">
                        <h4>Lab Technician</h4>
                    </div>
                    <img class="card-img-top" src="images/labtech.png" alt="Card image cap" style="width: 88px; height: 88px;">
                    <div class="card-body " style="margin-top: 10px;">
                        <p class="card-text">Run laboratory tests for patients</p>

                    </div>
                    <div class="card-footer">
                        
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#labLogin"style="width: 50%; margin-top: 20px;">Login</button>
                        
                    </div>
                </div>
            </div>

            <div id="staff-div" class="col-md-4">
                <div id="staff" class="card ">
                    <div class="card-head">
                        <h4>Accounts </h4>
                    </div>
                    <img class="card-img-top" src="images/accounts.png" alt="Card image cap" style="width: 88px; height: 88px;">
                    <div class="card-body " style="margin-top: 10px;">
                        <p class="card-text">Provides the price of treatment to the patients</p>

                    </div>
                    <div class="card-footer">
                        
                         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#accountsLogin"style="width: 50%; margin-top: 20px;"> Login</button>
                        
                    </div>
                </div>
            </div>

            <div id="staff-div" class="col-md-4">
                <div id="staff" class="card ">
                    <div class="card-head">
                        <h4>Pharmacy</h4>
                    </div>
                    <img class="card-img-top" src="images/pharmacy.png" alt="Card image cap" style="width: 88px; height: 88px;">
                    <div class="card-body " style="margin-top: 10px;">
                        <p class="card-text">Provides the patients with drugs or medicine.</p>

                    </div>
                    <div class="card-footer">
                    
                         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pharmacyLogin"style="width: 50%; margin-top: 20px;"> Login</button>
                        
                    </div>
                </div>
            </div>

        </div>

        <!-----------------------------------------------------------------------
        MODALS
------------------------------------------------------------------------->

         <!-- Receptionist Login Modal -->
        <div class="modal fade" id="receptionistLogin" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->

                <div class="modal-content">
                    <div class="modal-header">
                        <div class="panel panel-primary ">
                            <div class="panel-heading">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Receptionist Login</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="modal-body">
                                <form method="post" action="dboperations.php" name="create">
                                    <div class="form-group">
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required >
                                    </div>
                                    <div class="form-group">
                                        <label for="pass">Password</label>
                                        <input type="password" class="form-control" name="password" id="pass" placeholder="Password:" required>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="receptionLogin" class="btn btn-primary">Login</button>

                    </div>
                    </form>
                    <!--end form -->

                </div>

            </div>
        </div>

        </div>
        <!--end receptionist login modal-->

        <!-- Nurse Login Modal -->
        <div class="modal fade" id="nurseLogin" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->

                <div class="modal-content">
                    <div class="modal-header">
                        <div class="panel panel-primary ">
                            <div class="panel-heading">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Nurse Login</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="modal-body">
                                <form method="post" action="dboperations.php" name="create">
                                    <div class="form-group">
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required >
                                    </div>
                                    <div class="form-group">
                                        <label for="pass">Password</label>
                                        <input type="password" class="form-control" name="password" id="pass" placeholder="Password:" required>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="nurseLogin" class="btn btn-primary">Login</button>

                    </div>
                    </form>
                    <!--end form -->

                </div>

            </div>
        </div>

        </div>
        <!--end nurse login modal-->

         <!-- Doctor Login Modal -->
        <div class="modal fade" id="doctorLogin" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->

                <div class="modal-content">
                    <div class="modal-header">
                        <div class="panel panel-primary ">
                            <div class="panel-heading">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Doctor Login</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="modal-body">
                                <form method="post" action="dboperations.php" name="create">
                                    <div class="form-group">
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required >
                                    </div>
                                    <div class="form-group">
                                        <label for="pass">Password</label>
                                        <input type="password" class="form-control" name="password" id="pass" placeholder="Password:" required>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="doctorLogin" class="btn btn-primary">Login</button>

                    </div>
                    </form>
                    <!--end form -->

                </div>

            </div>
        </div>

        </div>
        <!--end doctor login modal-->

        <!-- Lab tech Login Modal -->
        <div class="modal fade" id="labLogin" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->

                <div class="modal-content">
                    <div class="modal-header">
                        <div class="panel panel-primary ">
                            <div class="panel-heading">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Lab Technician Login</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="modal-body">
                                <form method="post" action="dboperations.php" name="create">
                                    <div class="form-group">
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required >
                                    </div>
                                    <div class="form-group">
                                        <label for="pass">Password</label>
                                        <input type="password" class="form-control" name="password" id="pass" placeholder="Password:" required>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="labLogin" class="btn btn-primary">Login</button>

                    </div>
                    </form>
                    <!--end form -->

                </div>

            </div>
        </div>

        </div>
        <!--end lab tech login modal-->

        <!-- Accounts Login Modal -->
        <div class="modal fade" id="accountsLogin" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->

                <div class="modal-content">
                    <div class="modal-header">
                        <div class="panel panel-primary ">
                            <div class="panel-heading">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Accountant Login</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="modal-body">
                                <form method="post" action="dboperations.php" name="create">
                                    <div class="form-group">
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required >
                                    </div>
                                    <div class="form-group">
                                        <label for="pass">Password</label>
                                        <input type="password" class="form-control" name="password" id="pass" placeholder="Password:" required>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="accountsLogin" class="btn btn-primary">Login</button>

                    </div>
                    </form>
                    <!--end form -->

                </div>

            </div>
        </div>

        </div>
        <!-- end accounts login modal-->

        <!-- Pharmacy Login Modal -->
        <div class="modal fade" id="pharmacyLogin" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->

                <div class="modal-content">
                    <div class="modal-header">
                        <div class="panel panel-primary ">
                            <div class="panel-heading">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Pharmacist Login</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="modal-body">
                                <form method="post" action="dboperations.php" name="create">
                                    <div class="form-group">
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required >
                                    </div>
                                    <div class="form-group">
                                        <label for="pass">Password</label>
                                        <input type="password" class="form-control" name="password" id="pass" placeholder="Password:" required>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="pharmacyLogin" class="btn btn-primary">Login</button>

                    </div>
                    </form>
                    <!--end form -->

                </div>

            </div>
        </div>

        </div>
        <!-- end accounts login modal-->
    </body>

    </html>