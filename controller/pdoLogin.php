<?php
session_start();
require("../model/db.php");
require("../model/dbFunctions.php");

if (!empty([$_POST])) {
    $username = !empty($_POST['username'])? sanitise(($_POST['username'])): null;
    $password = !empty($_POST['password'])? sanitise(($_POST['password'])): null;
    //print_r($_POST);
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
            if ($_SESSION['level'] == "Admin") {
                header('location:../view/pages/adminPage.php');
            }
            if ($_SESSION['level'] == "Student") {
                header('location:../view/pages/studentPage.php');
            }
            if ($_SESSION['level'] == "Trainer") {
                header('location:../view/pages/trainerPage.php');
            }
        }
        else {
            echo "Login incorrect, please try again.";            
            echo "<br><a href='../index.php'>Login again</a>";
            
            //header('location:../index.php');
        }
    }
    catch(PDOException $e) {
        echo "Login problems".$e -> getMessage();
        die();
    }
}
?>