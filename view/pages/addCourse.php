<h2>Create a new course</h2>
<form action="?pageid=addingcourse"  method="post">
	<fieldset>
		<legend>Course details</legend>
		<label>Course name:</label>
		<input type="text" name=coursename required><br><br>
		<label>Description:</label>
		<input type="text" name=description required><br><br>
		<label>Course Level:</label>		
		<select name="level">
			<option value="Low">Entry Level</option>
			<option value="Medium">Medium Level</option>
			<option value="High">High Level</option>
		</select><br><br>
		<label>Price:</label>
		<input type="text" name=price required><br><br>
		<input type="hidden" name="actiontype" value="newcourse"/>
		<input type="submit">
		<input type="button" onclick="location.href='?pageid=showcourse';" value="Cancel" />
	</fieldset>
</form>
