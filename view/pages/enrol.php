<h2>Enrollment Form</h2>
<form action="../../controller/pdoEnrol.php"  method="post">
	<fieldset>
		<legend>Login details</legend>
		<label>Username:</label>
		<input type="text" name=username required><br><br>
		<label>Password:</label>
		<input type="text" name=password required><br><br>
		<label>Role:</label>		
		<input type="radio" name=role value="Student" checked="checked">Student  <br><br>
	</fieldset>
	<fieldset>
		<legend>Student details</legend>
		<label>Name:</label>
		<input type="text" name=name required><br><br>
		<label>Surname:</label>
		<input type="text" name=surname required><br><br>	
		<label>Address:</label>
		<input type="text" name=address required><br><br>	
		<label>Email:</label>
		<input type="text" name=email required><br><br>	
		<label>Phone:</label>
		<input type="text" name=phone required><br><br>	
		<label>Date of Birth:</label>
		<input type="date" name=dob required><br><br>
		<label>Class ID:</label>
		<input type="text" name=class required><br><br>			
		<input type="hidden" name="actiontype" value="enrol"/>
		<input type="submit">
		<input type="button" onclick="location.href='?pageid=home';" value="Cancel" />
	</fieldset>
</form>
