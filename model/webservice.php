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
  if($_GET['getData'] == 'pubs') {
    $sql = "SELECT * FROM pub";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(is_array($result) && sizeof($result) > 0) {
      echo json_encode($result);
    } else {
      echo array(['error'=>'true']);
    }
  }
  if($_GET['getData'] == 'addpub') {
    if(isset($_POST)) {
      $sql = "INSERT INTO pub (name, description, address, suburb, state, postcode, logo, last_updated, latitude, longitude)  VALUES (:pubname, :pubdesc, :pubaddress, :pubsuburb, :pubstate, :pubpcode, NULL, curtime(), :publat, :publong)";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':pubname', $_POST['pubname'], PDO::PARAM_STR, 256);
      $stmt->bindParam(':pubdesc', $_POST['pubdesc'], PDO::PARAM_STR, 256);
      $stmt->bindParam(':pubaddress', $_POST['pubaddress'], PDO::PARAM_STR, 128);
      $stmt->bindParam(':pubsuburb', $_POST['pubsuburb'], PDO::PARAM_STR, 128);
      $stmt->bindParam(':pubpcode', $_POST['pubpcode'], PDO::PARAM_INT, 5);
      $stmt->bindParam(':pubstate', $_POST['pubstate'], PDO::PARAM_STR, 128);
      $stmt->bindParam(':publat', $_POST['publat'], PDO::PARAM_STR, 10);
      $stmt->bindParam(':publong', $_POST['publong'], PDO::PARAM_STR, 10);
      $res = $stmt->execute();
      if($res == true) {
        echo json_encode(array(['insert'=>'true']));
      } else {
        echo json_encode(array(['error'=>'true']));
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

      if($stmt == true) {
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