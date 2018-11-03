<h2>User Registration Form</h2>
<form action="?pageid=addinguser"  method="post">
	<fieldset>
		<legend>Login details</legend>
		<label>Username:</label>
		<input type="text" name=username required><br><br>
		<label>Password:</label>
		<input type="password" name=password id="regpw"required><br>
		<input type="checkbox" onclick="showPassword()">Show Password<br><br>
		<label>Role:</label>		
		<input type="radio" name=role value="Admin">Admin  
		<input type="radio" name=role value="Trainer">Trainer		
		<input type="radio" name=role value="Customer">Customer<br><br>
	</fieldset>
	<fieldset>
		<legend>Personal details</legend>
		<label>Name:</label>
		<input type="text" name=name required><br><br>
		<label>Surname:</label>
		<input type="text" name=surname required><br><br>	
		<label>Email:</label>
		<input type="text" name=email onkeyup="doEmailCheck(this.value)" required><br>
		<div id="errmsg"></div><br>
		<input type="hidden" name="action_type" value="add"/>
		<input type="submit">
		<input type="button" onclick="location.href='index.php';" value="Cancel" />
	</fieldset>
</form>

