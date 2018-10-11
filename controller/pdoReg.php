<?php
session_start();
require("../model/db.php");
require("../model/dbFunctions.php");

if (!empty([$_POST])) {
    $username = !empty($_POST['username'])? sanitise(($_POST['username'])): null; 
    $mypass = !empty($_POST['password'])? sanitise(($_POST['password'])): null;
    $password = password_hash($mypass, PASSWORD_DEFAULT); 
    $role = !empty($_POST['role']) ? sanitise(($_POST['role'])): null;
    $name = !empty($_POST['name']) ? sanitise(($_POST['name'])): null;
    $surname = !empty($_POST['surname'])? sanitise(($_POST['surname'])): null;
    $email = !empty($_POST['email']) ? sanitise(($_POST['email'])): null;

    //echo $surname; //test if it works up to this point

    if($_REQUEST['action_type'] == 'add') {
        $query = $conn->prepare("SELECT username FROM login WHERE username = :user");
        $query->bindValue(':user', $username);
        $query->execute();
        if ($query->rowCount() < 1) {
            try {
                if ($role == "Admin") {
                    addUser($username, $password, $role, $name, $surname, $email);
                    $_SESSION['message'] = "Admin added successfully.";
                    header('Location: ../index.php');
                }
                if ($role == "Trainer") {
                    addTrainer($username, $password, $role, $name, $surname, $email);
                    $_SESSION['message'] = "Trainer added successfully.";
                    header('Location: ../index.php');
                }
                if ($role == "Student") {
                    addStudent($username, $password, $role, $name, $surname, $email);
                    $_SESSION['message'] = "Student added successfully.";
                    header('Location: ../index.php');
                }
            }
            catch(PDOException $e) { 
                echo "Account creation problems".$e -> getMessage();
                die();
            }        
        }
        else {
            $_SESSION['message'] = "Username already exists, try another.";
            header('Location: ../index.php');      
        }
        exit;
    }
}
?>
