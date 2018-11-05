
function addUserForm() {
  document.getElementById('adduserform').style.display = 'block';
  document.getElementById('userlist').style.display = 'none';
  document.getElementById('edituserform').style.display = 'none';
}

function hideUserForm() {
  document.getElementById('adduserform').style.display = 'none';
}

function AJAXaddUser() {
  var pubURL = "model/webservice.php?getData=adduser";
  $.ajax({
    url: pubURL,
    method: 'post',
    data: $('#adduserform').serialize(),
    datatype: 'json',
    success: function() {
      showModal();
      document.getElementById('modalheadertext').innerHTML = "Done";
      document.getElementById('modalheader').style.backgroundColor = "green";
      document.getElementById('modalfooter').style.backgroundColor = "green";
      document.getElementById('modaltext').innerHTML = "<p>User added successfully</p><button onclick='closeModal()'>OK</button>";
      getUsers();    
    },
    error: function(err) {
      console.log(err);
    }
  });
}


function getUsers() {
  var pubURL = "model/webservice.php?getData=users";
  $.ajax({
    url: pubURL,
    method: 'get',
    datatype: 'json',
    success: function(res) {
      listUsers(res);
    },
    error: function(err) {
      console.log(err);
    }
  });
}

function listUsers(usersArray) {
  outHTML = '';
  for(var loop=0;loop<usersArray.length;loop++) {
    outHTML += '<div class="holder">';
    outHTML += '<div class="frame">';
    outHTML += '<p>Full Name: ' + usersArray[loop].name + ' ' + usersArray[loop].surname +'</p>';
    outHTML += '<p>Username: ' + usersArray[loop].username + '</p>';
    outHTML += '<p>Email: ' + usersArray[loop].email + '</p>';
    outHTML += '<a href="#" class="button" onClick="editUserForm(' + usersArray[loop].login_id + ')">Edit</a>';
    outHTML += '<a href="#" class="button" onClick="modalDelUser(' + usersArray[loop].login_id + ')">Delete</a>';
    outHTML += '</div>';
    outHTML += '</div>';
  }
  document.getElementById('userlist').innerHTML = outHTML;
  document.getElementById('userlist').style.display = 'block';
  document.getElementById('edituserform').style.display = 'none';
  document.getElementById('adduserform').style.display = 'none';
}

function editUserForm(oneuser) {
  var userURL = "model/webservice.php?getData=oneuser&id=" + oneuser;
  $.ajax({
    url: userURL,
    method: 'get',
    datatype: 'json',
    success: function(res) {
      edituserform.style.display = 'block';
      populateForm(res);
    },
    error: function(err) {
      console.log(err);
    }
  });
}

function populateForm(user) {
  document.getElementById('usereditid').value = user.login_id;
  document.getElementById('usereditum').value = user.username;
  document.getElementById('usereditpw').value = '';
  document.getElementById('usereditname').value = user.name;
  document.getElementById('usereditsurname').value = user.surname;
  document.getElementById('usereditemail').value = user.email;
}

function AJAXupdateUser() {
  var pubURL = "model/webservice.php?getData=updateuser";
  $.ajax({
    url: pubURL,
    method: 'post',
    data: $('#edituserform').serialize(),
    datatype: 'json',
    success: function() {
      showModal();
      document.getElementById('modalheadertext').innerHTML = "Done";
      document.getElementById('modalheader').style.backgroundColor = "green";
      document.getElementById('modalfooter').style.backgroundColor = "green";
      document.getElementById('modaltext').innerHTML = "<p>User updated successfully</p><button onclick='closeModal()'>OK</button>";
      getUsers();
    },
    error: function(err) {
      console.log(err);
    }
  });
}

// render the delete user form in a modal
function deleteUserForm(loginid) {
  showModal();
  document.getElementById('modalheadertext').innerHTML = "WARNING! DELETING A USER"
  document.getElementById('modalheader').style.backgroundColor= "red";
  document.getElementById('modalfooter').style.backgroundColor= "red";
  document.getElementById('modaltext').innerHTML = '<form action="?pageid=deletinguser" method="post">	<fieldset> <p>Are you sure you wan to delete this account (login id: ' + loginid + ')?</p> <input type="hidden" name="rowid" value="' + loginid + '"><br> <input type="submit" value="Yes"> <input type="button" onclick="closeModal()" value="Cancel" />	</fieldset> </form>';
}

function AJAXdeleteUser(userid) {
  var userURL = "model/webservice.php?getData=deleteuser&userid=" + userid;
  $.ajax({
    url: userURL,
    method: 'get',
    datatype: 'json',
    success: function(res) {
      resetModal();
      showModal();
      document.getElementById('modalheadertext').innerHTML = "Done";
      document.getElementById('modalheader').style.backgroundColor = "green";
      document.getElementById('modalfooter').style.backgroundColor = "green";
      document.getElementById('modaltext').innerHTML = "<p>User deleted successfully</p><button onclick='closeModal()'>OK</button>";
      getUsers();
    },
    error: function(err) {
      console.log(err);
    }
  });
}


function showPassword() {
  var p1 = document.getElementById("regpw");   
  if (p1.type == "password") {
    p1.type = "text";
  } else {
    p1.type = "password";
  }
}


function doEmailCheck(emailAddr) {     
  var ajaxUrl = 'controller/checkemail.php?email=' + emailAddr;
  $.ajax({
    type: 'get',
    url: ajaxUrl,
    dataType: 'html',
    success: function(msg) {
        $("#errmsg").html(msg);
    }
  });
}

function showModal() {
  document.getElementById('myModal').style.display = "block";
}

function closeModal() {  
  resetModal();
  document.getElementById('myModal').style.display = "none";
}

function resetModal() {
  document.getElementById('modaltext').innerHTML = "Default content";
  document.getElementById('modalheadertext').innerHTML = "Default Modal Header";
  document.getElementById('modalheader').style.backgroundColor = "orange";
  document.getElementById('modalfooter').style.backgroundColor = "orange";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  var modal = document.getElementById('myModal');
  if (event.target == modal) {
    closeModal();
  }
}

function modalLoggedin() {
  document.getElementById('myModal').style.display = "block";
  document.getElementById('modaltext').innerHTML = "<p>You have logged in successfully</p><button onclick='closeModal()'>OK</button>";
  document.getElementById('modalheadertext').innerHTML = "WELCOME";
}

function loginFailed() {
  document.getElementById('myModal').style.display = "block";  
  document.getElementById('modalheader').style.backgroundColor= "red";
  document.getElementById('modalfooter').style.backgroundColor= "red";
  document.getElementById('modalheadertext').innerHTML = "Login Failed";
  document.getElementById('modaltext').innerHTML = "<p>Sorry, either your username or your password is incorrect</p><button onclick='closeModal()'>OK</button>";

}

function modalLogout() {
  document.getElementById('myModal').style.display = "block";
  document.getElementById('modaltext').innerHTML = "<p>You have successfully logged out</p><a class='button' href='index.php'>OK</a>";
  document.getElementById('modalheadertext').innerHTML = "GOOD BYE";
}

// modal button calling AJAX to delete user
function modalDelUser(userid) {
  document.getElementById('myModal').style.display = "block";
  document.getElementById('modalheadertext').innerHTML = "WARNING! DELETING A USER"
  document.getElementById('modalheader').style.backgroundColor= "red";
  document.getElementById('modalfooter').style.backgroundColor= "red";
  document.getElementById('modaltext').innerHTML = "<p>Are you sure you want to delete this user (login id: " + userid + ")?</p><button onclick='AJAXdeleteUser(" + userid + ")'>Yes</button> <button onclick='closeModal()'>Cancel</button>";
    /*var returnVal = confirm('Are you sure?');
  if(returnVal == true) {
    AJAXdeleteUser(userid);
  }*/
}