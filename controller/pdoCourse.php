<?php
session_start();
require("../model/db.php");
require("../model/dbFunctions.php");

if (!empty([$_POST])) {
    $coursename = !empty($_POST['coursename'])? sanitise(($_POST['coursename'])): null; 
    $description = !empty($_POST['description'])? sanitise(($_POST['description'])): null; 
    $level = !empty($_POST['level']) ? sanitise(($_POST['level'])): null;
    $price = !empty($_POST['price']) ? sanitise(($_POST['price'])): null;

    //echo $coursename; //test if it works up to this point

    if($_REQUEST['actiontype'] == 'newcourse') {
        $query = $conn->prepare("SELECT course_name FROM course WHERE course_name = :coursename");
        $query->bindValue(':coursename', $coursename);
        $query->execute();
        if ($query->rowCount() < 1) {
            try {
                addCourse($coursename, $description, $level, $price);
                header('location:../view/pages/adminPage.php');
            }
            catch(PDOException $e) { 
                echo "Account creation problems".$e -> getMessage();
                die();
            }           
        }
        else {
            $_SESSION['message'] = 'Course already exists, try another.';
            header('location:../view/pages/adminPage.php');
        }
        exit;
    }
}
?>
