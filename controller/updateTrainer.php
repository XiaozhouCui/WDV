<?php
session_start();

require("../model/db.php");
require("../model/dbFunctions.php");

if ($_SESSION['level'] == 'Admin') { 
    if($_POST['action_type'] == 'edit') {
        $username = !empty($_POST['username'])? sanitise(($_POST['username'])): null; 
        $mypass = !empty($_POST['password'])? sanitise(($_POST['password'])): null;
        $password = password_hash($mypass, PASSWORD_DEFAULT); //hash the password
        $role = !empty($_POST['role']) ? sanitise(($_POST['role'])): null;
        $name = !empty($_POST['name']) ? sanitise(($_POST['name'])): null;
        $surname = !empty($_POST['surname'])? sanitise(($_POST['surname'])): null;
        $email = !empty($_POST['email']) ? sanitise(($_POST['email'])): null;
        $rowid = !empty($_POST['rowid']) ? sanitise(($_POST['rowid'])): null;
        try {
            editTrainer($rowid, $username, $password, $role, $name, $surname, $email);
            $_SESSION['message'] = 'Trainer account updated successfully.';            
            header('location:../index.php');
        }
        catch(PDOException $e) { 
            echo "Account update problems".$e -> getMessage();
            die();
        } 
    } else {
        $_SESSION['message'] = 'Failed to update trainer account.';
        header('location:../index.php');
    }
} else {
    $_SESSION['message'] = 'Only administrator can edit trainer accounts.';
    header('location:../index.php');
}
?>