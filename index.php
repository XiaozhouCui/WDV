<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home</title>
<link href="view/css/style.css" rel="stylesheet">
</head>
<body>
<div class="flex-container">
  <header class="nav"><h1>SafeTec Pacific</h1></header>
  <nav class="nav">
    <div class="menuItem"><a href="index.php">HOME</a></div>
    <div class="menuItem">ABOUT US</div>
    <div class="menuItem">COURSES</div>
    <div class="menuItem">SERVICES</div>
    <div class="menuItem">CONTACT</div>
  </nav>
  <div class="contentLeft">
    <?php
    if (isset( $_SESSION['level'] ) ) {
      if ($_SESSION['level'] == "Admin") {
        echo '<p><a href="view/pages/adminPage.php">Back to Control Panel</a></p>';
      }
      if ($_SESSION['level'] == "Trainer") {
        echo '<p><a href="view/pages/trainerPage.php">Back to Control Panel</a></p>';
      }
      if ($_SESSION['level'] == "Student") {
        echo '<p><a href="view/pages/studentPage.php">Back to Control Panel</a></p>';
      }
    } else {
      echo " ";
    }
    ?>
  </div>
  <article>
    <div class="bigholder">
      <?php
      if (isset( $_GET['pageid'] ) ) {
        $action = $_GET['pageid'];
        if ( $action == 'home' ) {
          include("view/pages/login.php");
        }
        if ( $action == 'reg' ) {
          include("view/pages/registration.php");
        }
      } else {
        include("view/pages/login.php");
      }
      ?>
    </div>

    <div class="bigholder">
        <?php //include("view/pages/adminBookCentral.php"); ?>
    </div>

  </article>
  <div class="contentRight">right </div>
  <footer>
    <p>Debug info: <?php print_r($_SESSION); ?></p>
  </footer>
</div>
</body>
</html>
