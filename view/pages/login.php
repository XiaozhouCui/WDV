<h2>Login Form</h2>
<form action="controller/pdoLogin.php" method="post">
	<fieldset>
		<legend> Admin Login</legend>
			<label>Username:</label>
			<input type="text" name="username" required><br><br>
			<label>Password:</label>
			<input type="text" name="password" required><br><br>
			<input type="submit" value=" Login ">
			<input type="button" onclick="location.href='?pageid=reg';" value="Register" />
	</fieldset>
</form>