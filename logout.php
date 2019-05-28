  <?php
/* Log out process, unsets and destroys session variables */
session_start();
session_unset();
session_destroy(); 

$_SESSION['message'] = "You have been logged out!";
$_SESSION['msg_type'];
header("location: index.php");

?>