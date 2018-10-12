<?php

function loginAction() {
  global $conn;
  if (!empty([$_POST])) {
    $username = !empty($_POST['username'])? sanitise(($_POST['username'])): null;
    $password = !empty($_POST['password'])? sanitise(($_POST['password'])): null;    
    try {
      $stmt = $conn->prepare("SELECT * FROM login WHERE username=:user");
      $stmt->bindParam(':user', $username);
      $stmt->execute();
      $rows = $stmt -> fetch();        
      if (password_verify($password, $rows['password'])) {
        // assign session variables
        $_SESSION['login'] = $username;  
        $_SESSION['level'] = $rows['access_level'];
        $_SESSION['time_start_login'] = time();
        header('Location: index.php?pageid=loggedin');
      }
      else {
        echo "Login incorrect, please try again.";
      }
    }
    catch(PDOException $e) {
      echo "Login problems".$e -> getMessage();
      die();
    }
  }
}

function logoutAction() {
  if(isset($_SESSION['login']) != true)  {
    header("location: index.php");  
  }  
  else  {  
    session_unset(); 
    session_destroy();
    header("location: index.php");  
  }
}

function showUsersAction() {
  global $conn;
  $sql = "SELECT * FROM login INNER JOIN user ON login.login_id = user.login_id";    
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if($stmt->rowCount()< 1 ) {
    echo "The user database is empty.";
  } else {
    foreach($result as $row) {?>
      <div class="holder">
        <?php echo $row['name'].' '.$row['surname']; ?><br>
        <?php echo '<p>'. $row['email'].'</p>'; ?><br>
        <a href="?pageid=edituser&rowid=<?php echo $row['login_id']; ?>">Edit</a><br>
        <a href="?pageid=deleteuser&rowid=<?php echo $row['login_id']; ?>">Delete</a><br><br>
      </div>  
      <?php
    }
  }
}

function showTrainersAction() {
  global $conn;
  $sql = "SELECT * FROM login INNER JOIN trainer ON login.login_id = trainer.login_id";    
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if($stmt->rowCount()< 1 ) {
    echo "There is no trainer at the moment";
  } else {
    foreach($result as $row) {?>
      <div class="holder">
        <?php echo $row['name'].' '.$row['surname']; ?><br>
        <?php echo '<p>'. $row['email'].'</p>'; ?><br>
        <a href="?pageid=edittrainer&rowid=<?php echo $row['login_id']; ?>">Edit</a><br>
        <a href="?pageid=deleteuser&rowid=<?php echo $row['login_id']; ?>">Delete</a><br><br>
      </div>  
      <?php
    }
  }
}

function showCoursesAction() {
  global $conn;
  $sql = "SELECT course_id, course_name, course_level, price FROM course";    
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if($stmt->rowCount()< 1 ) {
    echo "The course database is empty.";
  } else {
    foreach($result as $row) {?>
      <div class="holder">
        <?php echo '<p>'. $row['course_name'].'</p>'; ?><br>
        <?php echo '<p>Course Level: '. $row['course_level'].'</p>'; ?><br>
        <?php echo '<p>Price: $'. $row['price'].'</p>'; ?><br>
        <a href="?pageid=editcourse&rowid=<?php echo $row['course_id']; ?>">Edit</a><br>
        <a href="?pageid=deletecourse&rowid=<?php echo $row['course_id']; ?>">Delete</a><br><br>
      </div>  
      <?php
    }
  }
}

function showClassesAction() {
  global $conn;
  $sql = "SELECT class.class_id, class.start_date, class.end_date, class.status, course.course_name, trainer.name FROM class INNER JOIN trainer ON class.trainer_id=trainer.trainer_id INNER JOIN course ON class.course_id=course.course_id";    
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if($stmt->rowCount()< 1 ) {
    echo "The course database is empty.";
  } else {
    foreach($result as $row) {?>
      <div class="holder">      
        <?php echo '<p>Start date: '. $row['start_date'].'</p>'; ?>
        <?php echo '<p>Start date: '. $row['end_date'].'</p>'; ?>
        <?php echo '<p>Status: '. $row['status'].'</p>'; ?>
        <?php echo '<p>Trainer: '. $row['name'].'</p>'; ?>
        <?php echo '<p>Topic: '. $row['course_name'].'</p>'; ?><br>
        <a href="?pageid=showclassstudent&rowid=<?php echo $row['class_id']; ?>">Manage Students</a><br>
        <a href="?pageid=editclass&rowid=<?php echo $row['class_id']; ?>">Edit</a><br>
        <a href="?pageid=deleteclass&rowid=<?php echo $row['class_id']; ?>">Delete</a><br><br>
      </div>  
      <?php
    }
  }
}

function showCurrentStudents() {
  global $conn;
  if ($_SESSION['level'] == 'Admin' OR $_SESSION['level'] == 'Trainer') { 
    $sql = "SELECT * FROM current_student";    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);	 
  
    if($stmt->rowCount()< 1 ) {
      echo "There is no currently enroled student";
    } else {
      foreach($result as $row) {?>
        <div class="holder">      
        <?php echo '<p>Name: '. $row['name'].' '.$row['surname']; ?><br>
        <?php echo '<p>Student ID: '. $row['student_id'].'</p>'; ?><br>
        <a href="?pageid=edituser&rowid=<?php echo $row['login_id']; ?>">Edit</a><br>
        <a href="?pageid=deleteuser&rowid=<?php echo $row['login_id']; ?>">Delete</a><br><br>
        </div>  
        <?php
      }
    }  
  } else {
    echo '<aside>Only administrator can edit student accounts.</aside>';
    echo "<aside><a href='index.php'>Go back</a></aside>";
  }
}

function showClassStudents() {
  global $conn;
  if ($_SESSION['level'] == 'Admin' OR $_SESSION['level'] == 'Trainer') { 
    $sql = "SELECT * FROM current_student WHERE class_id = '{$_GET['rowid']}'";    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);	 
  
    if($stmt->rowCount()< 1 ) {
      echo "This class has no student.";
    } else {
      foreach($result as $row) {?>
        <div class="holder">      
        <?php echo '<p>Name: '. $row['name'].' '.$row['surname']; ?><br>
        <?php echo '<p>Student ID: '. $row['student_id'].'</p>'; ?><br>
        <a href="?pageid=edituser&rowid=<?php echo $row['login_id']; ?>">Edit</a><br>
        <a href="?pageid=deleteuser&rowid=<?php echo $row['login_id']; ?>">Delete</a><br><br>
        </div>  
        <?php
      }
    }  
  } else {
    echo '<aside>Only administrator can edit student accounts.</aside>';
    echo "<aside><a href='index.php'>Go back</a></aside>";
  }
}

function delUserAction() {
  global $conn;
  if ($_SESSION['level'] == 'Admin') {
    $sql = "DELETE FROM login WHERE login.login_id = '". $_POST['rowid']."'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $_SESSION['message']="Admin user deleted successfully";
    header('Location: index.php');
  } else {
    echo "Only administrator can delete a user.";
  }
}

function showCustomers() {
  global $conn;
  if ($_SESSION['level'] == 'Admin') { 
    $sql = "SELECT * FROM prospective_student";    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);	 
  
    if($stmt->rowCount()< 1 ) {
      echo "There is no student to be enrolled";
    } else {
      foreach($result as $row) {?>
        <div class="holder">      
        <?php echo '<p>Name: '. $row['name'].' '.$row['surname']; ?><br>
        <?php echo '<p>Student ID: '. $row['email'].'</p>'; ?><br>
        <a href="?pageid=enrol&rowid=<?php echo $row['login_id']; ?>">Enrol</a><br>
        <a href="?pageid=deleteuser&rowid=<?php echo $row['login_id']; ?>">Delete</a><br><br>
        </div>  
        <?php
      }
    }  
  } else {
    echo '<aside>Only administrator can manage student accounts.</aside>';
    echo "<aside><a href='index.php'>Go back</a></aside>";
  }
}

function enrolStudent() {  
  global $conn;
  if (!empty([$_POST])) {
    $loginid = !empty($_POST['loginid'])? sanitise(($_POST['loginid'])): null; 
    $role = !empty($_POST['role']) ? sanitise(($_POST['role'])): null;
    $name = !empty($_POST['name']) ? sanitise(($_POST['name'])): null;
    $surname = !empty($_POST['surname'])? sanitise(($_POST['surname'])): null;
    $address = !empty($_POST['address']) ? sanitise(($_POST['address'])): null;
    $email = !empty($_POST['email']) ? sanitise(($_POST['email'])): null;
    $phone = !empty($_POST['phone']) ? sanitise(($_POST['phone'])): null;
    $dob = !empty($_POST['dob']) ? sanitise(($_POST['dob'])): null;
    $class = !empty($_POST['class']) ? sanitise(($_POST['class'])): null;
    if($_REQUEST['actiontype'] == 'enrol') {
      $query = $conn->prepare("SELECT login_id FROM login WHERE login_id = :loginid");
      $query->bindValue(':loginid', $loginid);
      $query->execute();
      if ($query->rowCount() >= 1) {
        try {
          enrol($loginid, $role, $name, $surname, $address, $email, $phone, $dob, $class);
          $_SESSION['message'] = "Student enrolled successfully.";
          header('Location: index.php');
        }
        catch(PDOException $e) { 
          echo "Enrollment problems".$e -> getMessage();
          die();
        }
      }
      else {
        $_SESSION['message'] = "Login ID does not exist.";
        header('Location: index.php');
      }
      exit;
    }
  }
}

?>