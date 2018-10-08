<?php 
session_start(); 
include("model/db.php");
include("model/dbFunctions.php");
include("view/pages/elements.php");

showHeader();
showMenu();
?>
  <article>
    <div class="bigholder">
      <?php
      if (isset($_GET['pageid']) && isset($_SESSION['login'])) {
        $action = $_GET['pageid'];
        if ( $action == 'home' ) {
          echo "This is the control panel.";
        }
        if ( $action == 'adduser' ) {
          include("view/pages/registration.php");
        }
        if ( $action == 'showuser' ) {
          include("controller/showUsers.php");
        }
        if ( $action == 'edituser' ) {
          include("view/pages/editUser.php");
        }
        if ( $action == 'deleteuser' ) {
          include("controller/delUser.php");
        }
        if ( $action == 'showtrainer' ) {
          include("controller/showTrainers.php");
        }
        if ( $action == 'edittrainer' ) {
          include("view/pages/editTrainer.php");
        }
        if ( $action == 'addcourse' ) {
          include("view/pages/addCourse.php");
        }
        if ( $action == 'showcourse' ) {
          include("controller/showcourses.php");
        }
        if ( $action == 'addclass' ) {
          include("view/pages/addClass.php");
        }
        if ( $action == 'showclass' ) {
          include("controller/showclasses.php");
        }
        if ( $action == 'showmates' ) {
          include ("controller/mymates.php");
        }
        if ( $action == 'showstudent' ) {
          include("controller/showStudents.php");
        }
        if ( $action == 'enrol' ) {
          include("view/pages/enrol.php");
        }
      } else {
        include("view/pages/login.php");
      }
      ?>
    </div> 
  </article>
<?php
showFooter();
?>
