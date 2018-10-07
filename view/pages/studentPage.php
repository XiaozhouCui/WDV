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

if (isset($_SESSION['login']) == true && $_SESSION['level']='Student') {
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Control Panel</title>
<link href="../css/style.css" rel="stylesheet">
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
      <li><a href="?pageid=showclass">Class Information</a></li>
      <li><a href="?pageid=showmates">Classmates</a></li>
    </ul>
  </div>
  <article>
    <div class="bigholder">
      <?php
      if (isset( $_GET['pageid'] ) ) {
        $action = $_GET['pageid'];
        if ( $action == 'home' ) {
          echo "Student Dashboard";
        }
        if ( $action == 'showclass' ) {
          include ("../../controller/myclass.php");
        }
        if ( $action == 'showmates' ) {
          include ("../../controller/mymates.php");
        }
      } else {
        echo "Admin control panel.";
      }
      ?>
    </div> 
  </article>
  <div class="contentRight">right </div>
  <footer>
    <p><?php print_r($_SESSION); ?></p>
  </footer>
</div>
</body>
</html> <?php

}  
else  {
  header("location:../../index.php");  
}
?>