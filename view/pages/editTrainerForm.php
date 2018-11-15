<?php

if ($_SESSION['level'] == 'Admin') { 
	$sql = "SELECT * FROM login INNER JOIN trainer ON login.login_id = trainer.login_id WHERE login.login_id = '{$_GET['rowid']}'";    
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);	 
	?>  

	<div class="bigholder">
		<h1>Edit Trainer</h1>
		<form action="?pageid=editingtrainer" class="needs-validation" method="post" novalidate>
			<input type="hidden" name="rowid" value="<?php echo $_GET['rowid'] ?>"><br>
				
			<div class="form-row">
				<div class="col-md-4 mb-3">
					<label>Username:</label>
					<input type="text" name="username" class="form-control" value="<?php echo $result['username'] ?>" required>
					<div class="invalid-feedback">
						Please provide a valid username.
					</div>
				</div>
				<div class="col-md-8 mb-3">
					<label>Password:</label>
					<input type="password" name="password" class="form-control" id="trainerpw" required>
					<input type="checkbox" onclick="showPassword3()">Show Password
					<div class="invalid-feedback">
						Please provide a valid password.
					</div>
				</div>
			</div>

			<div class="form-row">
				<div class="col-md-4 mb-3">
					<label>Role:</label>
					<select name="role" id="inputRole" class="form-control">
						<option id="roleop1" value="Admin" <?php echo ($result['access_level'] == "Admin" ? 'selected="selected"': ''); ?>>Admin</option>
						<option id="roleop2" value="Trainer" <?php echo ($result['access_level'] == "Trainer" ? 'selected="selected"': ''); ?>>Trainer</option>
						<option id="roleop3" value="Customer" <?php echo ($result['access_level'] == "Customer" ? 'selected="selected"': ''); ?>>Prospective Student</option>
					</select>
					<div class="invalid-feedback">
						Please select a role
					</div>
				</div>
				<div class="col-md-8 mb-3">
					<label>Email:</label>
					<input type="email" name="email" class="form-control" value="<?php echo $result['email'] ?>">
					<div class="invalid-feedback">
						Please provide a valid email
					</div>
				</div>
			</div>

			<div class="form-row">
				<div class="col-md-6 mb-3">
					<label>First Name:</label>
					<input type="text" name="name" class="form-control" value="<?php echo $result['name'] ?>" pattern="[A-Za-z ]+" required>
					<div class="invalid-feedback">
						Please spell first name in english letters
					</div>
				</div>
				<div class="col-md-6 mb-3">
					<label>Last Name:</label>
					<input type="text" name="surname" class="form-control" value="<?php echo $result['surname'] ?>" pattern="[A-Za-z ]+" required>
					<div class="invalid-feedback">
						Please spell Last name in english letters
					</div>
				</div>
			</div>
			<input type="hidden" name="action_type" value="edit"/>

			<button class="btn btn-primary" type="submit" >Submit</button>
			<button class="btn btn-primary" type="button" onclick="location.href='?pageid=showtrainer';">Cancel</button>
			
		</form>
	</div>
	<?php
} else {
	echo '<aside>Only administrator can edit trainer accounts.</aside>';
	echo "<aside><a href='index.php'>Go back</a></aside>";
}
?>






