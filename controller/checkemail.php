<?php

// check if the email exist, to be called from ajax code in .js file
if(isset($_GET['email'])) {
    $conn = new PDO("mysql:host=localhost; dbname=wdv",'root','');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $checkemail="SELECT email FROM (SELECT * FROM user UNION SELECT * FROM trainer UNION SELECT * FROM prospective_student) AS U WHERE U.email = :email";
    $stmt = $conn->prepare($checkemail);
    $stmt->bindParam(':email', $_GET['email']);
    $stmt->execute();
    $result = $stmt->fetch();

    if(is_array($result)) { # If rows are found for query
        echo "Email exists! Please try another one.";
    }
    else {
        echo "Email does not exist, OK to register";
    }
}
?>