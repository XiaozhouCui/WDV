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
    $address = !empty($_POST['address']) ? sanitise(($_POST['address'])): null;
    $email = !empty($_POST['email']) ? sanitise(($_POST['email'])): null;
    $phone = !empty($_POST['phone']) ? sanitise(($_POST['phone'])): null;
    $dob = !empty($_POST['dob']) ? sanitise(($_POST['dob'])): null;
    $class = !empty($_POST['class']) ? sanitise(($_POST['class'])): null;

    echo $surname; //test if it works up to this point

    if($_REQUEST['actiontype'] == 'enrol') {
        $query = $conn->prepare("SELECT username FROM login WHERE username = :user");
        $query->bindValue(':user', $username);
        $query->execute();
        if ($query->rowCount() < 1) {
            try {
                enrol($username, $password, $role, $name, $surname, $address, $email, $phone, $dob, $class);
                $_SESSION['message'] = "Student enrolled successfully.";
                header('location:../view/pages/adminPage.php');
            }
            catch(PDOException $e) { 
                echo "Enrollment problems".$e -> getMessage();
                die();
            }
        }
        else {
            $_SESSION['message'] = "Student already exists.";
            header('location:../view/pages/adminPage.php');
        }
        exit;
    }
}
?>
