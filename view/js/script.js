document.getElementById('edituserform').addEventListener('submit', AJAXupdateUser);

window.onload = function() {
  edituserform.style.display = 'none';
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
    success: function(res) {
      alert("User updated successfully");
    },
    error: function(err) {
      console.log(err);
    }
  });
}

function deleteUserForm(userid) {
  var returnVal = confirm('Are you sure?');
  if(returnVal == true) {
    AJAXdeleteUser(userid);
  }
}

function AJAXdeleteUser(userid) {
  var userURL = "model/webservice.php?getData=deleteuser&userid=" + userid;
  $.ajax({
    url: userURL,
    method: 'get',
    datatype: 'json',
    success: function(res) {
      alert("User deleted successfully");
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