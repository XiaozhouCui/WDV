<?php

if ($_SESSION['level'] == 'Admin') { 
	$sql = "SELECT * FROM login INNER JOIN user ON login.login_id = user.login_id WHERE login.login_id = '{$_GET['rowid']}'";    
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);	 
	?>  

	<div class="bigholder">
		<h1>Edit User</h1>
		<form action="controller/updateUser.php"  method="post">
			<fieldset>
				<legend>Login details</legend>
				<input type="hidden" name="rowid" value="<?php echo $_GET['rowid'] ?>"><br>
				<label>Username:</label>
				<input type="text" name=username value="<?php echo $result['username'] ?>"><br><br>
				<label>Password:</label>
				<input type="password" name=password value="<?php echo $result['password'] ?>"><br><br>
				<label>Role:</label>
				<input type="radio" name=role value="Admin" <?php echo ($result['access_level'] == "Admin" ? 'checked="checked"': ''); ?>>Admin  
				<input type="radio" name=role value="Trainer" <?php echo ($result['access_level'] == "Trainer" ? 'checked="checked"': ''); ?>>Trainer  
				<input type="radio" name=role value="Student" <?php echo ($result['access_level'] == "Student" ? 'checked="checked"': ''); ?>>Admin  
			</fieldset>
			<fieldset>
				<legend>Personal details</legend>
				<label>Given Name:</label>
				<input type="text" name=name value="<?php echo $result['name'] ?>"><br><br>
				<label>Surname:</label>
				<input type="text" name=surname value="<?php echo $result['surname'] ?>"><br><br>	
				<label>Email:</label>
				<input type="text" name=email value="<?php echo $result['email'] ?>"><br><br>	
				<input type="hidden" name="action_type" value="edit"/>
				<input type="submit">
				<input type="button" onclick="location.href='?pageid=showuser';" value="Cancel" />
			</fieldset>
		</form>
	</div>
	<?php
} else {
	echo '<aside>Only administrator can edit user accounts.</aside>';
	echo "<aside><a href='?pageid=home'>Go back</a></aside>";
	//header('location:../../controller/pdoLogout.php');
}?>






