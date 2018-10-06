<h2>Create a new class</h2>
<form action="../../controller/pdoClass.php"  method="post">
	<fieldset>
		<legend>Class details</legend>
		<label>Start Date:</label>
		<input type="date" name=date1 required><br><br>
		<label>End Date:</label>
		<input type="date" name=date2 required><br><br>
		<label>Class Status:</label>
		<select name="status">
			<option value="open">Enrolment Open</option>
			<option value="closed">Enrolment Closed</option>
			<option value="complete">Completed</option>
			<option value="cancelled">Cancelled</option>
		</select><br><br>
		<label>Instructor ID:</label>
		<input type="text" name=instructor required><br><br>
		<label>Course ID:</label>
		<input type="text" name=course required><br><br>
		<input type="hidden" name="actiontype" value="newcourse"/>
		<input type="submit">
		<input type="button" onclick="location.href='?pageid=home';" value="Cancel" />
	</fieldset>
</form>
