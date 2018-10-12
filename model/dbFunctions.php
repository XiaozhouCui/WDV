<?php
function addUser($username, $password, $role, $name, $surname, $email) {
    global $conn;
    try {
        $conn->beginTransaction(); //SQL transaction
        $newlogin = "INSERT INTO login(username, password, access_level) VALUES (:username, :password, :role)";
        $stmt = $conn->prepare($newlogin);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':role', $role);
        $stmt->execute();
        $lastLoginId = $conn->lastInsertId();

        $newuser = "INSERT INTO user(name, surname, email, login_id) VALUES (:name, :surname, :email, :loginId)";
        $stmt = $conn->prepare($newuser);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':surname', $surname);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':loginId', $lastLoginId);
        $stmt->execute();
        $conn->commit();   
    }
    catch(PDOException $ex) { 
        $conn->rollBack();
        throw $ex;
    }
}

function editUser($rowid, $username, $password, $role, $name, $surname, $email) {
    global $conn;
    try {
        $conn->beginTransaction(); //SQL transaction
        $editlogin = "UPDATE login SET username = :username, password = :password, access_level = :role WHERE login_id = :rowid";
        $stmt = $conn->prepare($editlogin);
        $stmt->bindValue(':rowid', $rowid);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':role', $role);
        $stmt->execute();

        $edituser = "UPDATE user SET name = :name, surname = :surname, email = :email WHERE login_id = :login_id";
        $stmt = $conn->prepare($edituser);
        $stmt->bindValue(':login_id', $rowid);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':surname', $surname);
        $stmt->bindValue(':email', $email);        
        $stmt->execute();
        $conn->commit();   
    }
    catch(PDOException $ex) { 
        $conn->rollBack();
        throw $ex;
    }
}

function addTrainer($username, $password, $role, $name, $surname, $email) {
    global $conn;
    try {
        $conn->beginTransaction(); //SQL transaction
        $newlogin = "INSERT INTO login(username, password, access_level) VALUES (:username, :password, :role)";
        $stmt = $conn->prepare($newlogin);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':role', $role);
        $stmt->execute();
        $lastLoginId = $conn->lastInsertId();

        $newuser = "INSERT INTO trainer(name, surname, email, login_id) VALUES (:name, :surname, :email, :loginId)";
        $stmt = $conn->prepare($newuser);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':surname', $surname);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':loginId', $lastLoginId);
        $stmt->execute();
        $conn->commit();   
    }
    catch(PDOException $ex) { 
        $conn->rollBack();
        throw $ex;
    }
}

function editTrainer($rowid, $username, $password, $role, $name, $surname, $email) {
    global $conn;
    try {
        $conn->beginTransaction(); //SQL transaction
        $editlogin = "UPDATE login SET username = :username, password = :password, access_level = :role WHERE login_id = :rowid";
        $stmt = $conn->prepare($editlogin);
        $stmt->bindValue(':rowid', $rowid);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':role', $role);
        $stmt->execute();

        $edittrainer = "UPDATE trainer SET name = :name, surname = :surname, email = :email WHERE login_id = :login_id";
        $stmt = $conn->prepare($edittrainer);
        $stmt->bindValue(':login_id', $rowid);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':surname', $surname);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $conn->commit();
    }
    catch(PDOException $ex) { 
        $conn->rollBack();
        throw $ex;
    }
}

function addStudent($username, $password, $role, $name, $surname, $email) {
    global $conn;
    try {
        $conn->beginTransaction(); //SQL transaction
        $newlogin = "INSERT INTO login(username, password, access_level) VALUES (:username, :password, :role)";
        $stmt = $conn->prepare($newlogin);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':role', $role);
        $stmt->execute();
        $lastLoginId = $conn->lastInsertId();

        $newuser = "INSERT INTO prospective_student(name, surname, email, login_id) VALUES (:name, :surname, :email, :loginId)";
        $stmt = $conn->prepare($newuser);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':surname', $surname);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':loginId', $lastLoginId);
        $stmt->execute();
        $conn->commit();   
    }
    catch(PDOException $ex) { 
        $conn->rollBack();
        throw $ex;
    }
}


function addCourse($coursename, $description, $level, $price) {
    global $conn;
    try {
        $newcourse = "INSERT INTO course(course_name, description, course_level, price) VALUES (:coursename, :description, :level, :price)";
        $stmt = $conn->prepare($newcourse);
        $stmt->bindValue(':coursename', $coursename);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':level', $level);
        $stmt->bindValue(':price', $price);
        $stmt->execute();  
    }
    catch(PDOException $e) { 
        echo "Failed to create a course.".$e -> getMessage();
        die();
    }
}

function editCourse($rowid, $coursename, $description, $level, $price) {
    global $conn;
    try {
        $editcourse = "UPDATE course SET course_name = :coursename, description = :description, course_level = :level, price = :price WHERE course_id = :rowid";
        $stmt = $conn->prepare($editcourse);
        $stmt->bindValue(':rowid', $rowid);
        $stmt->bindValue(':coursename', $coursename);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':level', $level);
        $stmt->bindValue(':price', $price);
        $stmt->execute();
    }
    catch(PDOException $ex) { 
        $conn->rollBack();
        throw $ex;
    }
}

function enrol($loginid, $role, $name, $surname, $address, $email, $phone, $dob, $class) {
    global $conn;
    try {
        $conn->beginTransaction(); 
        //Step 1: upgrade access level
        $newrole = "UPDATE login SET access_level = :role WHERE login_id = :loginid";
        $stmt = $conn->prepare($newrole);
        $stmt->bindValue(':loginid', $loginid);
        $stmt->bindValue(':role', $role);
        $stmt->execute();
        //Step 2: create student details in student table
        $newstudent = "INSERT INTO current_student(name, surname, address, email, phone, dob, login_id, class_id) VALUES (:name, :surname, :address, :email, :phone, :dob, :loginid, :classId)";
        $stmt = $conn->prepare($newstudent);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':surname', $surname);
        $stmt->bindValue(':address', $address);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':phone', $phone);
        $stmt->bindValue(':dob', $dob);
        $stmt->bindValue(':loginid', $loginid);
        $stmt->bindValue(':classId', $class);
        $stmt->execute();
        //Step 3: remove customer details from customer table
        $delcustomer = "DELETE FROM prospective_student WHERE login_id = :loginid";
        $stmt = $conn->prepare($delcustomer);
        $stmt->bindValue(':loginid', $loginid);
        $stmt->execute();

        $conn->commit();   
    }
    catch(PDOException $ex) { 
        $conn->rollBack();
        throw $ex;
    }
}

function sanitise($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function showMessage() {
    echo '<div id="errmsg"></div>';// ajax output
    if(isset($_SESSION['message'])) { 
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}
?>