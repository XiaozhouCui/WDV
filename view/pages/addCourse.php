
<form class="needs-validation" action="?pageid=addingcourse" method="post" novalidate>
  <h2>Create a New Course</h2>
  <div class="form-group">
    <label>Course Name</label>
    <input type="text" name="coursename" class="form-control" required>
    <div class="invalid-feedback">
      Please provide a valid course name
    </div>
	</div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="inputRole">Course Level</label>
      <select name="level" id="inputRole" class="form-control" required>
        <option value="Low">Entry Level</option>
        <option value="Medium">Medium Level</option>
        <option value="High">High Level</option>
      </select>
    </div>
    <div class="col-md-6 mb-3">
      <label>Price</label>
      <div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">$</div>
				</div>
        <input type="number" name="price" class="form-control" step="0.01" min="0" required>
        <div class="invalid-feedback">
          Please provide a valid amount
        </div>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label>Course Description</label>
    <textarea name="description" class="form-control" rows="5" required></textarea>
	</div>
	<input type="hidden" name="actiontype" value="newcourse"/>
	<button type="submit" class="btn btn-primary">Submit</button>
	<button type="button" class="btn btn-primary" onclick="location.href='?pageid=loggedin';">Cancel</button>
</form>
