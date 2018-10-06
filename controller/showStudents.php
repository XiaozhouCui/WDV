<?php

if ($_SESSION['level'] == 'Admin' OR $_SESSION['level'] == 'Trainer') { 
	$sql = "SELECT * FROM current_student WHERE class_id = '{$_GET['rowid']}'";    
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);	 

	if($stmt->rowCount()< 1 ) {
		echo "This class has no student.";
	} else {
		foreach($result as $row) {?>
			<div class="holder">      
      <?php echo '<p>Name: '. $row['name'].' '.$row['surname']; ?><br>
      <?php echo '<p>Student ID: '. $row['student_id'].'</p>'; ?><br>
      <a href="?pageid=edituser&rowid=<?php echo $row['login_id']; ?>">Edit</a><br>
      <a href="?pageid=deleteuser&rowid=<?php echo $row['login_id']; ?>">Delete</a><br><br>
			</div>  
			<?php
		}
	}

} else {
	echo '<aside>Only administrator can edit user accounts.</aside>';
	echo "<aside><a href='?pageid=home'>Go back</a></aside>";
	//header('location:../../controller/pdoLogout.php');
}?>






