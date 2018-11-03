<?php
if ($_SESSION['level'] == 'Admin') { 
	$sql = "SELECT * FROM login INNER JOIN current_student ON login.login_id = current_student.login_id WHERE login.login_id = '{$_GET['rowid']}'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);	
	if ($result['access_level'] == "Student") {
		?>  
		<div class="bigholder">
			<h2>Student Details</h2>
			<form action="?pageid=editingstudent"  method="post">
				<fieldset>
          <legend>Login details</legend>
          <input type="hidden" name=loginid value="<?php echo $result['login_id'] ?>">
					<label>Username: 
          <input type="text" name=username value="<?php echo $result['username'] ?>" required><br><br>			
					<label>Password: 
          <input type="password" name=password required><br><br>		
					<input type="hidden" name=role value="Student">
				</fieldset>
				<fieldset>
					<legend>Student details</legend>
					<label>Name:</label>
					<input type="text" name=name value="<?php echo $result['name'] ?>" required><br><br>
					<label>Surname:</label>
					<input type="text" name=surname value="<?php echo $result['surname'] ?>" required><br><br>	
					<label>Address:</label>
					<input type="text" name=address value="<?php echo $result['address'] ?>"required><br><br>	
					<label>Email:</label>
					<input type="text" name=email value="<?php echo $result['email'] ?>" required><br><br>	
					<label>Phone:</label>
					<input type="text" name=phone value="<?php echo $result['phone'] ?>"required><br><br>	
					<label>Date of Birth:</label>
					<input type="date" name=dob value="<?php echo $result['dob'] ?>"required><br><br>
					<label>Class ID:</label>
					<input type="text" name=class value="<?php echo $result['class_id'] ?>"required><br><br>			
					<input type="hidden" name="actiontype" value="editstudent"/>
					<input type="submit">
					<input type="button" onclick="location.href='?pageid=showstudent';" value="Cancel" />
				</fieldset>
			</form>
		</div>
		<?php
	} else {
		echo "<p>The selected profile is not current students, please check the role of this person.</p>";
		echo "<aside><a href='index.php'>Go back</a></aside>";
	}
} else {
	echo '<aside>Only administrator can edit a student.</aside>';
	echo "<aside><a href='index.php'>Go back</a></aside>";
}?>