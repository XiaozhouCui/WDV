<?php

// check if the username exists
if(isset($_GET['username'])) {
  $conn = new PDO("mysql:host=localhost; dbname=wdv",'root','');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $checkusername="SELECT * FROM login WHERE username = :username";
  $stmt = $conn->prepare($checkusername);
  $stmt->bindParam(':username', $_GET['username']);
  $stmt->execute();
  $result = $stmt->fetch();

  if(is_array($result)) { # If rows are found for query
    echo "taken";
  }
  else {
    echo "ok";
  }
}
?>