<?php
// check if the email exists
if(isset($_GET['email'])) {
    $conn = new PDO("mysql:host=localhost; dbname=wdv",'root','');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $checkemail="SELECT email FROM (SELECT email FROM user UNION SELECT email FROM trainer UNION SELECT email FROM current_student UNION SELECT email FROM prospective_student) AS U WHERE U.email = :email";
    $stmt = $conn->prepare($checkemail);
    $stmt->bindParam(':email', $_GET['email']);
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