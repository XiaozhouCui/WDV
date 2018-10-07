<?php
session_start();
// auto logout after 20 minutes
if((time() - $_SESSION['time_start_login']) > 1200) {
  header("location: ../../controller/pdoLogout.php");
} else {
  $_SESSION['time_start_login'] = time();
} 
require("../../model/db.php");
require("../../model/dbFunctions.php");

if (isset($_SESSION['login']) == true && $_SESSION['level'] == 'Admin') {
?>

<!doctype html>
<html>
<head>
<title>Admin Control Panel</title>
<link href="../css/style.css" rel="stylesheet">
<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="../js/script.js"></script>
</head>
<body>
<div class="flex-container">
  <header>
    <p>Welcome <strong><?php echo $_SESSION['login'];?>!</strong> You have successfully logged in.</p>
    <a href="../../controller/pdoLogout.php">Logout</a>
  </header>
  <nav>
    <div class="menuItem"><a href="../../index.php">HOME</a></div>
    <div class="menuItem">ABOUT US</div>
    <div class="menuItem">COURSES</div>
    <div class="menuItem">SERVICES</div>
    <div class="menuItem">CONTACT</div>
  </nav>
  <div class="contentLeft">Admin Panel
    <ul>      
      <li><a href="?pageid=adduser">Create User</a></li>
      <li><a href="?pageid=showuser">Manage Admin</a></li>
      <li><a href="?pageid=showtrainer">Manage Instructor</a></li>
      <li><a href="?pageid=addcourse">Create Course</a></li>
      <li><a href="?pageid=showcourse">Manage Course</a></li>
      <li><a href="?pageid=addclass">Create Class</a></li>
      <li><a href="?pageid=showclass">Manage Class</a></li>
      <li><a href="?pageid=enrol">Enrol Student</a></li>
    </ul>
  </div>
  <article>
    <div class="bigholder">
      <?php
      if (isset( $_GET['pageid'] ) ) {
        $action = $_GET['pageid'];
        if ( $action == 'home' ) {
          echo "Admin control panel.";
        }
        if ( $action == 'adduser' ) {
          include("registration.php");
        }
        if ( $action == 'showuser' ) {
          include("../../controller/showUsers.php");
        }
        if ( $action == 'edituser' ) {
          include("editUser.php");
        }
        if ( $action == 'deleteuser' ) {
          include("../../controller/delUser.php");
        }
        if ( $action == 'showtrainer' ) {
          include("../../controller/showTrainers.php");
        }
        if ( $action == 'edittrainer' ) {
          include("editTrainer.php");
        }
        if ( $action == 'addcourse' ) {
          include("addCourse.php");
        }
        if ( $action == 'showcourse' ) {
          include("../../controller/showcourses.php");
        }
        if ( $action == 'addclass' ) {
          include("addClass.php");
        }
        if ( $action == 'showclass' ) {
          include("../../controller/showclasses.php");
        }
        if ( $action == 'showstudent' ) {
          include("../../controller/showStudents.php");
        }
        if ( $action == 'enrol' ) {
          include("enrol.php");
        }
      } else {
        echo "Admin control panel.";
      }
      ?>
    </div> 
  </article>
  <div class="contentRight">right </div>
  <footer>
  <?php showMessage(); ?>
  </footer>
</div>
</body>
</html> <?php

}  
else  {
  header("location:../../index.php");  
}
?>