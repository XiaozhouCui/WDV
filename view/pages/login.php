<h2>Login Form</h2>
<form action="?pageid=loggingin" method="post">
	<fieldset>
		<legend>Login</legend>
			<label>Username:</label>
			<input type="text" name="username" required><br><br>
			<label>Password:</label>
			<input type="text" name="password" required><br><br>
			<input type="submit" value=" Login ">
			<input type="button" onclick="location.href='index.php';" value="Cancel" />
	</fieldset>
</form>