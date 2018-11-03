<?php
function showHeader() {
?>
  <!doctype html>
  <html>
  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <link href="view/css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="view/js/script.js" defer></script>
  </head>
  <body>
    <div class="flex-container">
      <header class="nav"><h1>SafeTec Pacific</h1><p>
      </p></header>
      <nav class="nav">
        <div class="menuItem"><a href="index.php">HOME</a></div>
        <div class="menuItem">ABOUT US</div>
        <div class="menuItem">COURSES</div>
        <div class="menuItem">SERVICES</div>
        <div class="menuItem">CONTACT</div>
      </nav>
<?php
}

function showMenu() {  ?>
  <div class="controlPanel"> <?php
    if (isset( $_SESSION['level'] ) ) {
      if ($_SESSION['level'] == "Admin") { ?>
        <ul>
          <li><a href="?pageid=adduser">Create a User</a></li>
          <li><a href="?pageid=showuser">Manage Admins</a></li>
          <li><a href="?pageid=showtrainer">Manage Trainers</a></li>
          <li><a href="?pageid=showstudent">Manage Students</a></li>
          <li><a href="?pageid=showcustomer">Manage Customers</a></li>
          <li><a href="?pageid=addcourse">Create a Course</a></li>
          <li><a href="?pageid=showcourse">Manage Courses</a></li>
          <li><a href="?pageid=addclass">Create a Class</a></li>
          <li><a href="?pageid=showclass">Manage Classes</a></li>
          <li><a href="?pageid=logout">Logout</a></li>
        </ul><?php
      }
      if ($_SESSION['level'] == "Trainer") { ?>
        <ul>      
          <li><a href="?pageid=addclass">Create Class</a></li>
          <li><a href="?pageid=showclass">Manage Class</a></li>
          <li><a href="?pageid=logout">Logout</a></li>
        </ul><?php
      }
      if ($_SESSION['level'] == "Student") { ?>
        <ul>      
          <li><a href="?pageid=showclass">Class Information</a></li>
          <li><a href="?pageid=showmates">Classmates</a></li>
          <li><a href="?pageid=logout">Logout</a></li>
        </ul><?php
      }
      if ($_SESSION['level'] == "Customer") { ?>
        <ul>      
          <li><a href="?pageid=showcourse">Show Courses</a></li>
          <li><a href="?pageid=showclass">Class Timetable</a></li> 
          <li><a href="?pageid=enrolForm">Course Application</a></li>
          <li><a href="?pageid=logout">Logout</a></li>
        </ul><?php
      }
    } else {
      echo "Login to see the menu";
    }?>
  </div><?php
}

function showFooter() {?>
    <div class="contentRight"></div>
    <footer>
      <?php 
        echo "<div>";
        print_r($_SESSION);
        echo "</div><div>";
        print_r($_GET);
        echo "</div><div>";
        print_r($_POST);
        echo "</div>";
      ?>
    </footer>
  </div>
  </body>
  </html> <?php
}

?>