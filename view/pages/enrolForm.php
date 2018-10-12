<?php

if ($_SESSION['level'] == 'Admin') { 
	$sql = "SELECT * FROM login INNER JOIN prospective_student ON login.login_id = prospective_student.login_id WHERE login.login_id = '{$_GET['rowid']}'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);	
	if ($result['access_level'] == "Customer") {
		?>  
		<div class="bigholder">
			<h2>Enrollment Form</h2>
			<form action="?pageid=enrolling"  method="post">
				<fieldset>
					<legend>Login details</legend>
					<label>Login ID: <?php echo $result['login_id'] ?></label><br><br>		
					<label>Customer Number: <?php echo $result['customer_id'] ?></label><br><br>	
					<input type="hidden" name=loginid value="<?php echo $result['login_id'] ?>">
					<label>Username: <?php echo $result['username'] ?></label><br><br>	
					<label>To be enroled as a Current Student</label>
					<input type="hidden" name=role value="Student">
				</fieldset>
				<fieldset>
					<legend>Student details</legend>
					<label>Name:</label>
					<input type="text" name=name value="<?php echo $result['name'] ?>" required><br><br>
					<label>Surname:</label>
					<input type="text" name=surname value="<?php echo $result['surname'] ?>" required><br><br>	
					<label>Address:</label>
					<input type="text" name=address required><br><br>	
					<label>Email:</label>
					<input type="text" name=email value="<?php echo $result['email'] ?>" required><br><br>	
					<label>Phone:</label>
					<input type="text" name=phone required><br><br>	
					<label>Date of Birth:</label>
					<input type="date" name=dob required><br><br>
					<label>Class ID:</label>
					<input type="text" name=class required><br><br>			
					<input type="hidden" name="actiontype" value="enrol"/>
					<input type="submit">
					<input type="button" onclick="location.href='index.php';" value="Cancel" />
				</fieldset>
			</form>
		</div>
		<?php
	} else {
		echo "<p>Enrolment is only available for prospective students, please go back.</p>";
		echo "<aside><a href='index.php'>Go back</a></aside>";
	}
} else {
	echo '<aside>Only administrator can enrol a student.</aside>';
	echo "<aside><a href='index.php'>Go back</a></aside>";
}?>