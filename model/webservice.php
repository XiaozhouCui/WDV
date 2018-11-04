<?php
header('Content-Type: application/json');

$conn = new PDO("mysql:host=127.0.0.1;dbname=wdv", 'root','');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function sanitise($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(isset($_GET['getData'])) {
  if($_GET['getData'] == 'oneuser') {
    $sql = "SELECT * FROM login INNER JOIN user ON login.login_id = user.login_id WHERE login.login_id = :loginid";   
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':loginid', $_GET['id'], PDO::PARAM_INT, 5);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if(is_array($result) && sizeof($result) > 0) {
      echo json_encode($result);
    } else {
      echo json_encode(array(['error'=>'true']));
    } 
  }
  if($_GET['getData'] == 'users') {
    $sql = "SELECT * FROM login INNER JOIN user ON login.login_id = user.login_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(is_array($result) && sizeof($result) > 0) {
      echo json_encode($result);
    } else {
      echo array(['error'=>'true']);
    }
  }
  if($_GET['getData'] == 'adduser') {
    if (!empty([$_POST])) {
      $username = !empty($_POST['username'])? sanitise(($_POST['username'])): null; 
      $mypass = !empty($_POST['password'])? sanitise(($_POST['password'])): null;
      $password = password_hash($mypass, PASSWORD_DEFAULT); 
      $role = !empty($_POST['role']) ? sanitise(($_POST['role'])): null;
      $name = !empty($_POST['name']) ? sanitise(($_POST['name'])): null;
      $surname = !empty($_POST['surname'])? sanitise(($_POST['surname'])): null;
      $email = !empty($_POST['email']) ? sanitise(($_POST['email'])): null;
  
      if($_REQUEST['action_type'] == 'add') {
        $query = $conn->prepare("SELECT username FROM login WHERE username = :user");
        $query->bindValue(':user', $username);
        $query->execute();
        if ($query->rowCount() < 1) {
          try {
            $conn->beginTransaction(); 
            $newlogin = "INSERT INTO login(username, password, access_level) VALUES (:username, :password, :role)";
            $stmt = $conn->prepare($newlogin);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $password);
            $stmt->bindValue(':role', $role);
            $stmt->execute();
            $lastLoginId = $conn->lastInsertId();
    
            $newuser = "INSERT INTO user(name, surname, email, login_id) VALUES (:name, :surname, :email, :loginId)";
            $stmt = $conn->prepare($newuser);
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':surname', $surname);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':loginId', $lastLoginId);
            $stmt->execute();
            $conn->commit();   

            echo json_encode(array(['insert'=>'true']));
          }
          catch(PDOException $e) { 
            echo "Account creation problems".$e -> getMessage();
            die();
          }        
        }
        else {
          echo "Username already exists, try another.";
          echo json_encode(array(['error'=>'true']));
        }
        exit;
      }
    }
  }
  if($_GET['getData'] == 'updateuser') {
    if(isset($_POST)) {
      $username = !empty($_POST['username'])? sanitise(($_POST['username'])): null; 
      $mypass = !empty($_POST['password'])? sanitise(($_POST['password'])): null;
      $password = password_hash($mypass, PASSWORD_DEFAULT); //hash the password
      $role = !empty($_POST['role']) ? sanitise(($_POST['role'])): null;
      $name = !empty($_POST['name']) ? sanitise(($_POST['name'])): null;
      $surname = !empty($_POST['surname'])? sanitise(($_POST['surname'])): null;
      $email = !empty($_POST['email']) ? sanitise(($_POST['email'])): null;
      $rowid = !empty($_POST['rowid']) ? sanitise(($_POST['rowid'])): null;

      $conn->beginTransaction(); //SQL transaction
      $editlogin = "UPDATE login SET username = :username, password = :password, access_level = :role WHERE login_id = :rowid";
      $stmt = $conn->prepare($editlogin);
      $stmt->bindValue(':rowid', $rowid);
      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':password', $password);
      $stmt->bindValue(':role', $role);
      $stmt->execute();

      $edituser = "UPDATE user SET name = :name, surname = :surname, email = :email WHERE login_id = :login_id";
      $stmt = $conn->prepare($edituser);
      $stmt->bindValue(':login_id', $rowid);
      $stmt->bindValue(':name', $name);
      $stmt->bindValue(':surname', $surname);
      $stmt->bindValue(':email', $email);        
      $stmt->execute();
      $conn->commit();   

      if($conn == true) {
        echo json_encode(array(['update'=>'true']));
      } else {
        echo json_encode(array(['error'=>'true']));
      }             
    }
  }
  if($_GET['getData'] == 'deleteuser') {
    $userid = (int)$_GET['userid'];
    $sql = "DELETE FROM login WHERE login.login_id = :userid";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':userid', $userid, PDO::PARAM_INT, 5);
    $res = $stmt->execute();
    if($res == true) {
      echo json_encode(array(['delete'=>'true']));
    } else {
      echo json_encode(array(['error'=>'true']));
    }
  }
}
?>