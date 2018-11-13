<?php
function showHeader() {
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Home</title>
  <link href="view/css/style.css" rel="stylesheet">
  <link href="view/css/dropzone.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="view/js/script.js"></script>
  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script src="view/js/dropzone.js"></script>
</head>
<body>
  <!-- The Modal (background) -->
  <div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modalcontent">
      <div class="modalheader" id="modalheader" >
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 id="modalheadertext">Default Modal Header</h2>
      </div>
      <div class="modalbody">
        <div id="modaltext">Default content</div>
      </div>
      <div class="modalfooter" id="modalfooter">
        <h3 id="modalfootertext"></h3>
      </div>
    </div>
  </div>
  <div class="flex-container">
    <header class="nav">
      <p><h1>SafeTec Pacific</h1></p>
    </header>
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
  <div class="controlPanel"> 
    <?php
    if (isset( $_SESSION['level'] ) ) { ?>
    <div class="panel">
      <p>Control Panel</p><?php
      if ($_SESSION['level'] == "Admin") { ?>      
        <ul>
          <li><a href="?pageid=ajax">AJAX Tricks</a></li>
          <li><a href="?pageid=adduser">Create a User</a></li>
          <li><a href="?pageid=showuser">Manage Admins</a></li>          
          <li><a href="?pageid=showtrainer">Manage Trainers</a></li>
          <li><a href="?pageid=showstudent">Manage Students</a></li>
          <li><a href="?pageid=showcustomer">Manage Customers</a></li>
          <li><a href="?pageid=addcourse">Create a Course</a></li>
          <li><a href="?pageid=showcourse">Manage Courses</a></li>
          <li><a href="?pageid=addclass">Create a Class</a></li>
          <li><a href="?pageid=showclass">Manage Classes</a></li>
          <li><a href="?pageid=showallfile">Manage Files</a></li>
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
      }?>
    </div><?php
    } else {
      echo "<div class='bigholder'>Login to see the menu</div>";
    }?>
    
  </div><?php
}

function showFooter() {?>
    <div class="contentRight"></div>
    <footer>
      <!-- Show PHP session messages -->
      <div class="bigholder"><?php  
        if(isset($_SESSION['error'])) {
        echo "<div>{$_SESSION['error']}</div>";
        unset($_SESSION['error']);
        }
        if(isset($_SESSION['message'])) {
        echo "<div>{$_SESSION['message']}</div>";
        unset($_SESSION['message']);
        }?>
      </div> 
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