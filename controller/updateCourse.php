<?php
session_start();

require("../model/db.php");
require("../model/dbFunctions.php");

if ($_SESSION['level'] == 'Admin') { 
  if($_POST['actiontype'] == 'editcourse') {
    $coursename = !empty($_POST['coursename'])? sanitise(($_POST['coursename'])): null; 
    $description = !empty($_POST['description'])? sanitise(($_POST['description'])): null; 
    $level = !empty($_POST['level']) ? sanitise(($_POST['level'])): null;
    $price = !empty($_POST['price'])? sanitise(($_POST['price'])): null;
    $rowid = !empty($_POST['rowid']) ? sanitise(($_POST['rowid'])): null;
    try {
        editCourse($rowid, $coursename, $description, $level, $price);
        $_SESSION['message'] = 'Course updated successfully.';            
        header('location:../index.php');
    }
    catch(PDOException $e) { 
        echo "Course update problems".$e -> getMessage();
        die();
    } 
  } else {
    $_SESSION['message'] = 'Failed to update course.';
    header('location:../index.php');
  }
} else {
  $_SESSION['message'] = 'Only administrator can edit courses.';
  header('location:../index.php');
}
?>