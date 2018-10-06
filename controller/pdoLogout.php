<?php
session_start();

if(isset($_SESSION['login']) != true)  {
    //if($_SESSION['login'] = false)  
    header("location:../index.php");  
}  
else  {  
    session_unset(); 
    header("location:../index.php");  
}
?>