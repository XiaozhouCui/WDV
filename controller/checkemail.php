<?php

// check if the email exist, to be called from ajax code in .js file
if(isset($_GET['email'])) {
    $conn = new PDO("mysql:host=localhost; dbname=wdv",'root','');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $checkemail="SELECT * FROM user WHERE email = :email";
    $stmt = $conn->prepare($checkemail);
    $stmt->bindParam(':email', $_GET['email']);
    $stmt->execute();    
    $result = $stmt->fetch();

    if(is_array($result)) { # If rows are found for query
        echo "Email exists!";
    }
    else {
        echo "Email does not exist, OK to register";
    }
}
?>