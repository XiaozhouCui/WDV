<?php

if ($_SESSION['level'] == 'Admin') { 
	$sql = "SELECT * FROM login INNER JOIN prospective_student ON login.login_id = prospective_student.login_id WHERE login.login_id = '{$_GET['rowid']}'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);	

  $sql2 = "SELECT * FROM class";   
  $stmt2 = $conn->prepare($sql2);
	$stmt2->execute();
  $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);	 

	if ($result['access_level'] == "Customer") {
		?>  
		<div class="bigholder">
			
			<form action="?pageid=enrolling" class="needs-validation" method="post" novalidate>
			<h2>Enrollment Form</h2>
				<div class="form-row">
					<div class="col-md-6 mb-3">
						<label>Login ID: <?php echo $result['login_id'] ?></label>	
					</div>
					<div class="col-md-6 mb-3">
						<label>Customer Number: <?php echo $result['customer_id'] ?></label>
					</div>
				</div>

				<label>Username: <?php echo $result['username'] ?></label>
				<input type="hidden" name=loginid value="<?php echo $result['login_id'] ?>">
				<input type="hidden" name="role" value="Student">

				<div class="form-group">
					<label>To be enroled as a Current Student</label>
				</div>

				<div class="form-row">
					<div class="col-md-6 mb-3">
						<label>First Name:</label>
						<input type="text" name="name" class="form-control" pattern="[A-Za-z ]+" value="<?php echo $result['name'] ?>" required>
						<div class="invalid-feedback">
							Please spell first name in english letters
						</div>
					</div>
					<div class="col-md-6 mb-3">
						<label>Last Name:</label>
						<input type="text" name="surname" class="form-control" pattern="[A-Za-z ]+" value="<?php echo $result['surname'] ?>" required>
						<div class="invalid-feedback">
							Please spell last name in english letters
						</div>
					</div>
				</div>

				<div class="form-group">
					<label>Full Address:</label>
					<input type="text" name="address" class="form-control" required>
					<div class="invalid-feedback">
						Please provide a valid address
					</div>
				</div>

				<div class="form-row">
					<div class="col-md-6 mb-3">
						<label>Email:</label>
						<input type="email" name="email" class="form-control" value="<?php echo $result['email'] ?>" required>
						<div class="invalid-feedback">
							Please provide a valid email
						</div>
					</div>
					<div class="col-md-6 mb-3">
						<label>Phone:</label>
						<input type="number" name="phone" class="form-control" required>
					</div>
					<div class="invalid-feedback">
						Please provide a valid phone number
					</div>
				</div>

				<div class="form-row">
					<div class="col-md-6 mb-3">
						<label>Date of Birth:</label>
						<input type="date" name="dob" class="form-control" required>
						<div class="invalid-feedback">
							Please select a valid date
						</div>
					</div>
					<div class="col-md-6 mb-3">
						<label>Class ID:</label>
						<select name="class" class="form-control" required>		
						<?php   
						foreach($result2 as $row2) {
							echo '<option value="'.$row2['class_id'].'">'.$row2['class_id'].' - Starts: '.$row2['start_date'].'</option>';
						}
						?> 
						</select>
					</div>
					<div class="invalid-feedback">
						Please select a valid class ID number
					</div>
				</div>

					<input type="hidden" name="actiontype" value="enrol"/>

					<button class="btn btn-primary" type="submit">Submit</button>
					<button class="btn btn-primary" type="button" onclick="location.href='?pageid=showcustomer';">Cancel</button>

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