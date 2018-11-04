document.getElementById('edituserform').addEventListener('submit', AJAXupdateUser);
document.getElementById('adduserform').addEventListener('submit', AJAXaddUser);

window.onload = function() {
  document.getElementById('edituserform').style.display = 'none';
  document.getElementById('adduserform').style.display = 'none';
}

function addUserForm() {
  document.getElementById('adduserform').style.display = 'block';
  document.getElementById('userlist').style.display = 'none';
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
      alert("User added successfully");      
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
    outHTML += '<a href="#" class="button" onClick="deleteUserForm(' + usersArray[loop].login_id + ')">Delete</a>';
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
      alert("User updated successfully");      
      getUsers();      
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