<h2>User Registration Form</h2>

<form class="needs-validation" action="?pageid=addinguser"  method="post" novalidate>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="username01">Username</label>
      <input type="text" name="username" class="form-control" id="username01" onkeyup="doUsernameCheck(this.value)" required>
      <div class="invalid-feedback">
        Please provide a valid username.
      </div>
      <span id="errmsg01" class="errmsg"></span>
    </div>
    <div class="col-md-8 mb-3">
      <label for="password01">Password</label>
      <input type="password" name="password" class="form-control" id="password01" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}" required>
      <div class="invalid-feedback">
        Please provide a valid password.
      </div>
      <small id="passwordHelpBlock" class="form-text text-muted">
      <input type="checkbox" onclick="showPassword1()">Show Password. 8-20 characters long, include at least 1 number, 1 upper and 1 lower case letter.
      </small>
    </div>
    <input type="hidden" name="action_type" value="add"/>
  </div>

  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="inputRole">Role</label>
      <select name="role" id="inputRole" class="form-control">
        <option id="roleop1" value="Admin" disabled>Admin</option>
        <option id="roleop2" value="Trainer" disabled>Trainer</option>
        <option id="roleop3" value="Customer" selected>Prospective Student</option>
      </select>
    </div>
    <div class="col-md-8 mb-3">
      <label for="email01">Email</label>
      <div class="input-group">
        <input type="email" name="email" class="form-control" id="email01" onkeyup="doEmailCheck(this.value)" required>
        <div class="invalid-feedback">
          Please provide a valid email
        </div>
        <span id="errmsg02" class="errmsg"></span>
      </div>
    </div>
  </div>

  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom01">First name</label>
      <input type="text" name="name" class="form-control" id="validationCustom01" pattern="[A-Za-z ]+" required>
      <div class="invalid-feedback">
        Please spell first name in english letters
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Last name</label>
      <input type="text" name="surname" class="form-control" id="validationCustom02" pattern="[A-Za-z ]+"  required>
      <div class="invalid-feedback">
        Please spell last name in english letters
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      <label class="form-check-label" for="invalidCheck">
        By creating an account you agree to our <a href="#">Terms & Privacy</a>.
      </label>
      <div class="invalid-feedback">
        You must agree before submitting.
      </div>
    </div>
  </div>
  <button class="btn btn-primary" type="submit" id="submitform01">Submit</button>
  <button class="btn btn-primary" type="button" id="cancelform01" onclick="location.href='index.php';">Cancel</button>
</form>

<?php 
if(isset($_SESSION['level']) && $_SESSION['level'] == "Admin") {
  echo 
  '<script type="text/javascript">',
  'roleop1.disabled = false;',
  'roleop2.disabled = false;',
  '</script>';
}
?>

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