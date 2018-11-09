<?php 
session_start(); 
include("model/db.php");
include("model/dbFunctions.php");
include("controller/actions.php");
include("view/pages/elements.php");
date_default_timezone_set('Australia/Brisbane');//set time zone to Brisbane

showHeader();
showMenu();
?>
<article>
  <!-- Show PHP session messages -->
  <div><?php  
  if(isset($_SESSION['error'])) {
  echo "<div>{$_SESSION['error']}</div>";
  unset($_SESSION['error']);
  }
  if(isset($_SESSION['message'])) {
  echo "<div>{$_SESSION['message']}</div>";
  unset($_SESSION['message']);
  }?>
  </div>  
  <!-- The Modal (background) -->
  <div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header" id="modalheader" >
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 id="modalheadertext">Default Modal Header</h2>
      </div>
      <div class="modal-body">
        <div id="modaltext">Default content</div>
      </div>
      <div class="modal-footer" id="modalfooter">
        <h3 id="modalfootertext"></h3>
      </div>
    </div>
  </div>
  <!-- All calling functions start here -->
  <div class="bigholder">
    <?php
    if (isset($_GET['pageid'])) {
      if ($_GET['pageid'] == 'login') {
        include("view/pages/login.php");
      }
      if ($_GET['pageid'] == 'loggingin') {
        loginAction();
      }
      if ($_GET['pageid'] == 'reg') {
        include("view/pages/registration.php");
      }
    } 
    if (isset($_SESSION['login'])) {
      if (isset($_GET['pageid'])) {
        $action = $_GET['pageid'];
        if ( $action == 'loggedin' ) {
          include("view/pages/loggedInPage.php");
        }
        if ( $action == 'ajax' ) {
          include("view/pages/ajaxPage.html");
        }
        if ( $action == 'adduser' ) {
          include("view/pages/registration.php");
        }
        if ( $action == 'addinguser' ) {
          addUserAction();
        }
        if ( $action == 'showuser' ) {
          showUsersAction();
        }
        if ( $action == 'edituser' ) {
          include("view/pages/editUserForm.php");
        }
        if ( $action == 'deleteuser' ) {
          include("view/pages/delUserForm.php");
        }
        if ( $action == 'deletinguser' ) {
          delUserAction();  
        }
        if ( $action == 'showtrainer' ) {
          showTrainersAction();
        }
        if ( $action == 'edittrainer' ) {
          include("view/pages/editTrainerForm.php");
        }
        if ( $action == 'showstudent' ) {
          showCurrentStudents();
        }
        if ( $action == 'editstudent' ) {
          include("view/pages/editStudentForm.php");
        }
        if ( $action == 'editingstudent' ) {
          editCurrentStudent();
        }
        if ( $action == 'addcourse' ) {
          include("view/pages/addCourse.php");
        }
        if ( $action == 'addingcourse' ) {
          addCourseAction();
        }
        if ( $action == 'showcourse' ) {
          showCoursesAction();
        }
        if ( $action == 'editcourse' ) {
          include("view/pages/editCourseForm.php");
        }
        if ( $action == 'editingcourse' ) {
          editCourseAction();
        }
        if ( $action == 'deletecourse' ) {
          include("view/pages/delCourseForm.php");
        }
        if ( $action == 'deletingcourse' ) {
          delCourseAction();
        }
        if ( $action == 'addclass' ) {
          include("view/pages/addClassForm.php");
        }
        if ( $action == 'addingclass' ) {
          addClassAction();
        }
        if ( $action == 'showclass' ) {
          showClassesAction();
        }
        if ( $action == 'editclass' ) {
          include("view/pages/editClassForm.php");
        }
        if ( $action == 'editingclass' ) {
          editClassAction();
        }
        if ( $action == 'deleteclass' ) {
          include("view/pages/delClassForm.php");
        }
        if ( $action == 'deletingclass' ) {
          delClassAction();
        }
        if ( $action == 'showmates' ) {
          include ("controller/mymates.php");
        }
        if ( $action == 'upload' ) {
          include ("view/pages/uploadForm.php");
        }
        if ( $action == 'uploading' ) {
          uploadFileAction();
        }
        if ( $action == 'dropzone' ) {
          dropzoneAction();
        }
        if ( $action == 'showallfile' ) {
          showAllFiles();
        }
        if ( $action == 'showfiles' ) {
          showClassFiles();
        }
        if ( $action == 'deletefile' ) {
          include ("view/pages/delFileForm.php");
        }
        if ( $action == 'deletingfile' ) {
          delFileAction();
        }
        if ( $action == 'showclassstudent' ) {
          showClassStudents();
        }
        if ( $action == 'showcustomer' ) {
          showCustomers();
        }
        if ( $action == 'enrol' ) {
          include("view/pages/enrolForm.php");
        }
        if ( $action == 'enrolling' ) {
          enrolStudent();
        }
        if ( $action == 'logout' ) {
          logoutAction();
        }
      }
    }
    else {
      echo "<p>Please login to see the content</p>";
      echo "<a href='?pageid=login'>Login</a> or ";
      echo "<a href='?pageid=reg'>Register</a>";
    }
    ?>
  </div> 
</article>
<?php
showFooter();
?>
