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
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-129344631-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-129344631-1');
  </script>

</head>
<body>
<div id="main">
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
  <div class="flex-container" >
    <header class="nav">
      <p><h1>SafeTec Pacific</h1></p>
    </header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navburger" aria-controls="navburger" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse bg-dark" id="navburger" >
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="openNav()">☰ Sidebar <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <?php if(isset($_SESSION['level'])) {
              echo '<a class="nav-link" href="?pageid=logout">Logout</a>';
            } else {
              echo '<a class="nav-link" href="?pageid=login">Lougin</a>';
            }  ?> 
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
    <?php
    }

    function showMenu() {  ?>
    <div id="mySidebar" class="sidebar"> 
      <div >
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="index.php">Home</a>
      </div>


    <?php
    if (isset( $_SESSION['level'] ) ) { 
      echo '<a href="#">Profile</a>';
      echo '<a href="#">Settings</a>';
      echo '<a href="?pageid=logout">Logout</a>';
      ?>
      <div class="panel">
        <h4>Control Panel</h4><?php
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
            <li><a href="?pageid=myclass">Class Information</a></li>
            <li><a href="?pageid=classfiles">Learning Materials</a></li>
            <li><a href="?pageid=showmessage">Message Board</a></li>
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
        echo "<a href='?pageid=login'>Login</a>";
        echo "<a href='?pageid=reg'>Register</a>";
      }?>
      
    </div><?php
}

function showFooter() {?>
    <div class="contentRight"></div>

    <!-- Footer with Bootstrap Grid Layout -->
    <footer class="page-footer font-small text-light bg-dark">
      <div class="container text-center text-md-left mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase font-weight-bold">SafeTec Pacific</h6>
            <hr class="accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width:80px;">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
          </div>
          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase font-weight-bold">Courses</h6>
            <hr class="accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width:80px;">
            <p><a href="#">PHA Ficilitation</a></p>
            <p><a href="#">Loss Prevention</a></p>
            <p><a href="#">Risk Management</a></p>
            <p><a href="#">Functional Safety</a></p>
          </div>
          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase font-weight-bold">Useful links</h6>
            <hr class="accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 80px;">
            <p><a href="#">Privacy Policy</a></p>
            <p><a href="#">Payment & Refund</a></p>
            <p><a href="#">Timetable</a></p>
            <p><a href="#">Help</a></p>
          </div>
          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Content -->
            <h6 class="text-uppercase font-weight-bold">Contact</h6>
            <hr class="accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 80px;">
            <p>XX Victoria Street</p>
            <p>Brisbane, QLD 4000, AU</p>
            <p>info@example.com</p>
            <p>+ 61 1234 5678</p>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
      <!-- Footer Links -->
      <!-- Copyright -->
      <div class="footer-copyright text-center py-3 text-light bg-secondary">© 2018 Copyright: SafeTec Pacific
      </div>
    </footer>

    
  </div>
  </div>
  </body>
  </html> <?php
}

?>