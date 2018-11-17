<h2>Login</h2>

<form action="?pageid=loggingin" method="post">
  <div class="form-group">
    <label for="login_username">Username</label>
    <input type="text" name="username" class="form-control" id="login_username" required placeholder="Enter username">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Enter password" required>
	</div>
	<div class="form-group">
		<div class="form-check">
			<input type="checkbox" class="form-check-input" onclick="rememberValue()">
			<label class="form-check-label">Remember my username</label>
		</div>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary">Submit</button>
		<button type="button" class="btn btn-primary" onclick="location.href='index.php';">Cancel</button>
	</div>
</form>