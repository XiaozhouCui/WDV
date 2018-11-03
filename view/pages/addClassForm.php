<h2>Create a new class</h2>
<form action="?pageid=addingclass"  method="post">
	<fieldset>
		<legend>Class details</legend>
		<label>Start Date:</label>
		<input type="date" name="startdate" required><br><br>
		<label>End Date:</label>
		<input type="date" name="enddate" required><br><br>
		<label>Class Status:</label>
		<select name="status">
			<option value="Enrollment Open">Enrollment Open</option>
			<option value="Enrollment Closed">Enrollment Closed</option>
			<option value="Completed">Completed</option>
			<option value="Cancelled">Cancelled</option>
		</select><br><br>
		<label>Instructor ID:</label>
		<input type="text" name="trainerid" required><br><br>
		<label>Course ID:</label>
		<input type="text" name="courseid" required><br><br>
		<input type="hidden" name="actiontype" value="addclass"/>
		<input type="submit">
		<input type="button" onclick="location.href='?pageid=home';" value="Cancel" />
	</fieldset>
</form>
