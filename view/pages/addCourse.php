<h2>Create a new course</h2>

<form class="needs-validation" action="?pageid=addingcourse" method="post" novalidate>
  <div class="form-group">
    <label>Course Name</label>
    <input type="text" name="coursename" class="form-control" required>
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


<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>