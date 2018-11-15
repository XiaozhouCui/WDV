<?php
header('Content-Type: application/json');

include('db.php');

function sanitise($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function deleteFile($fileid) {
  global $conn;
  try {
    $sql = "DELETE FROM learning_material WHERE content_id = :fileid";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':fileid', $fileid, PDO::PARAM_INT, 5);
    $res = $stmt->execute();
  }
  catch(PDOException $e) { 
    echo "Failed to delete a class from database. ".$e -> getMessage();
    die();
  }
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
  if($_GET['getData'] == 'files') {
    $sql = "SELECT * FROM learning_material";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(is_array($result) && sizeof($result) > 0) {
      echo json_encode($result);
    } else {
      echo array(['error'=>'true']);
    }
  }
  if($_GET['getData'] == 'deletefile') {    
    $fileid = !empty($_GET['fileid'])? sanitise(($_GET['fileid'])): null;
    $sql= "SELECT * FROM learning_material WHERE content_id = :fileid";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':fileid', $fileid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);        
    $Path = '.'.$result['content_link'];
    
    if (file_exists($Path)){
      if (unlink($Path)) {   
        $response_array['status'] = 'success';
        deleteFile($fileid);
      } else {
        $response_array['status'] = 'error';
      }   
    } else {
      $response_array['status'] = 'notfound';
      deleteFile($fileid);
    }
    echo json_encode($response_array);
  }
  
  if($_GET['getData'] == 'listtrainer') {
    $sql = "SELECT trainer_id, name, surname FROM trainer ORDER BY trainer_id ASC LIMIT 20"; 
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if(is_array($result)) {
      echo json_encode($result); // create json
    } else {
      echo json_encode(array("Error"=>"true"));
    }
  }

  if($_GET['getData'] == 'listcourse') {
    $sql = "SELECT course_id, course_name FROM course ORDER BY course_id ASC LIMIT 20"; 
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if(is_array($result)) {
      //print_r($result);	
      echo json_encode($result); // create json
    } else {
      echo json_encode(array("Error"=>"true"));
    }
  }

  if($_GET['getData'] == 'checkreg') {    
    if(isset($_GET['email'])) {
      $checkemail="SELECT email FROM (SELECT email FROM user UNION SELECT email FROM trainer UNION SELECT email FROM current_student UNION SELECT email FROM prospective_student) AS U WHERE U.email = :email";
      $stmt = $conn->prepare($checkemail);
      $stmt->bindParam(':email', $_GET['email']);
      $stmt->execute();
      $result = $stmt->fetch();
  
      if(is_array($result)) { # If rows are found for query
        $response['status'] = 'taken'; 
      }
      else {
        $response['status'] = 'ok'; 
      }
      echo json_encode($response);
    }

    if(isset($_GET['username'])) {
      $checkusername="SELECT * FROM login WHERE username = :username";
      $stmt = $conn->prepare($checkusername);
      $stmt->bindParam(':username', $_GET['username']);
      $stmt->execute();
      $result = $stmt->fetch();
    
      if(is_array($result)) { # If rows are found for query
        $response['status'] = 'taken'; 
      }
      else {
        $response['status'] = 'ok'; 
      }
      echo json_encode($response);
    }
  }
}
?>