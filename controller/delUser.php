<?php 
$sql = "DELETE FROM login WHERE login.login_id = '". $_GET['rowid']."'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$_SESSION['message']="Admin user deleted successfully";

?>