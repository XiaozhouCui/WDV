<h2>User Registration Form</h2>
<form action="controller/pdoReg.php"  method="post">
	<fieldset>
		<legend>Login details</legend>
		<label>Username:</label>
		<input type="text" name=username required><br><br>
		<label>Password:</label>
		<input type="text" name=password required><br><br>
		<label>Role:</label>		
		<input type="radio" name=role value="Admin">Admin  
		<input type="radio" name=role value="Trainer">Trainer		
		<input type="radio" name=role value="Customer">Prospective Student<br><br>
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
		<input type="hidden" name="action type" value="add"/>
		<input type="submit">
		<input type="button" onclick="location.href='index.php?pageid=loggedin';" value="Cancel" />
	</fieldset>
</form>

