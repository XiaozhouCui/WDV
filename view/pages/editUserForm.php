<?php

if ($_SESSION['level'] == 'Admin') { 
	$sql = "SELECT * FROM login INNER JOIN user ON login.login_id = user.login_id WHERE login.login_id = '{$_GET['rowid']}'";    
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);	 
	?>  
	<h1>Edit User</h1>
	<form action="?pageid=editinguser" class="needs-validation" method="post" novalidate>

		<div class="form-row">
			<div class="col-md-4 mb-3">
				<input type="hidden" name="rowid" value="<?php echo $_GET['rowid'] ?>">
				<label>Username:</label>
				<input type="text" name=username class="form-control" value="<?php echo $result['username'] ?>">
				<div class="invalid-feedback">
        	Please provide a valid username.
      	</div>
			</div>
    	<div class="col-md-8 mb-3">
				<label>Password:</label>
				<input type="password" name=password class="form-control" id="userpw" required>
				<div class="invalid-feedback">
					Please provide a valid password.
				</div>
			</div>
		</div>

		<div class="form-row">
			<div class="col-md-4 mb-3">
				<label>Access Level:</label>
				<select name="role" class="form-control">
					<option value="Admin" <?php echo ($result['access_level'] == "Admin" ? 'selected="selected"': ''); ?>>Admin</option>
					<option value="Trainer" <?php echo ($result['access_level'] == "Trainer" ? 'selected="selected"': ''); ?>>Trainer</option>
					<option value="Customer" <?php echo ($result['access_level'] == "Customer" ? 'selected="selected"': ''); ?>>Prospective Student</option>
				</select>
			</div>
			<div class="col-md-8 mb-3">
				<label>Email</label>
				<input type="email" name="email" class="form-control" value="<?php echo $result['email'] ?>" required>
				<div class="invalid-feedback">
					Please provide a valid email
				</div>
			</div>
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
					Please spell first name in english letters
				</div>
			</div>
		</div>
		<input type="hidden" name="action_type" value="edit"/>
		<button class="btn btn-primary" type="submit">Submit</button>
		<button class="btn btn-primary" type="button" onclick="location.href='?pageid=showuser';">Cancel</button>
	</form>
	<?php
} else {
	echo '<aside>Only administrator can edit user accounts.</aside>';
	echo "<aside><a href='index.php'>Go back</a></aside>";
}?>






