<h2>Login Form</h2>
<form action="?pageid=loggingin" method="post">
	<fieldset>
		<legend>Login</legend>
			<label>Username:</label>
			<input type="text" name="username" id="login_username" onchange="rememberValue(this.value)" required><br><br>
			<label>Password:</label>
			<input type="password" name="password" required><br><br>
			<input type="submit" value=" Login ">
			<input type="button" onclick="location.href='index.php';" value="Cancel" />
	</fieldset>
</form>