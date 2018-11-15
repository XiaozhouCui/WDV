<script type="text/javascript">
	listCourses();
	listTrainers();
</script>

<h2>Create a new class</h2>
<form class="needs-validation" action="?pageid=addingclass"  method="post" novalidate>
	<div class="form-row">
		<div class="col-md-6 mb-3">
			<label>Start Date:</label>
			<input type="date" name="startdate" class="form-control" required>
			<div class="invalid-feedback">
				Please select a start date
			</div>
		</div>
		<div class="col-md-6 mb-3">
			<label>End Date:</label>
			<input type="date" name="enddate" class="form-control" required>
			<div class="invalid-feedback">
				Please select an end date
			</div>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-6 mb-3">
			<label>Class Status:</label>
			<select name="status" class="form-control" required>
				<option value="Enrollment Open">Enrollment Open</option>
				<option value="Enrollment Closed">Enrollment Closed</option>
				<option value="Completed">Completed</option>
				<option value="Cancelled">Cancelled</option>
			</select>
		</div>
		<div class="col-md-6 mb-3">
			<label>Instructor ID:</label>
			<select id="trainer_list" name="trainerid" class="form-control" required>
				<option>Please select a trainer</option>
			</select>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-12 mb-3">
			<label>Course ID:</label>
			<select id="course_list" name="courseid" class="form-control" required>
				<option>Please select a course</option>
			</select>
		</div>
	</div>
	<input type="hidden" name="actiontype" value="addclass"/>
	<button type="submit" class="btn btn-primary">Submit</button>
	<button type="button" class="btn btn-primary" onclick="location.href='?pageid=loggedin';">Cancel</button>
</form>
