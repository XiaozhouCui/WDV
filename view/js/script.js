// get last login name from local storage
window.onload = function() {
  if(document.getElementById('login_username') != null) {
    if(localStorage.getItem("username") != null) {
      document.getElementById('login_username').value = localStorage.getItem('username')
    }
  }
}

function rememberValue(value) {  
  localStorage.setItem("username", value);  
}

function addUserForm() {
  document.getElementById("adduserform").reset();
  document.getElementById('adduserform').style.display = 'block';
  document.getElementById('userlist').style.display = 'none';
  document.getElementById('filelist').style.display = 'none';
  document.getElementById('edituserform').style.display = 'none';
}

function closeUserForm() {
  document.getElementById("adduserform").reset();
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
      modalSuccess()
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
  //show SVG loading animation effect
  document.getElementById('userlist').style.display = 'block';
  $('#userlist').html('<img src="view/images/flaskloader.svg"/>');  
  $.ajax({
    url: pubURL,
    method: 'get',
    datatype: 'json',
    success: function(res) {
      document.getElementById("edituserform").reset();
      listUsers(res); //render json code into html
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
  document.getElementById('filelist').style.display = 'none';
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
      userlist.style.display = 'none';
      populateForm(res);
    },
    error: function(err) {
      console.log(err);
    }
  });
}

function populateForm(user) {  
  document.getElementById('usereditid').value = user.login_id;
  document.getElementById('usereditun').value = user.username;
  document.getElementById('usereditpw').value = '';
  document.getElementById('usereditname').value = user.name;
  document.getElementById('usereditsurname').value = user.surname;
  document.getElementById('usereditemail').value = user.email;
  validity2();
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
    success: function() {
      modalSuccess();
      document.getElementById('modaltext').innerHTML = "<p>User deleted successfully</p><button onclick='closeModal()'>OK</button>";
      getUsers();
    },
    error: function(err) {
      console.log(err);
    }
  });
}


function getFiles() {
  var pubURL = "model/webservice.php?getData=files";
  document.getElementById('filelist').style.display = 'block';
  $('#userlist').html('<img src="view/images/flaskloader.svg"/>');  
  $.ajax({
    url: pubURL,
    method: 'get',
    datatype: 'json',
    success: function(res) {
      listFiles(res);
    },
    error: function(err) {
      console.log(err);
    }
  });
}

function listFiles(filesArray) {
  outHTML = '';
  for(var loop=0;loop<filesArray.length;loop++) {
    outHTML += '<div class="holder">';
    outHTML += '<div class="frame">';
    outHTML += '<p>File name: <a href="' + filesArray[loop].content_link + '">' + filesArray[loop].file_name + '</a></p>';
    outHTML += '<p>Class No.: ' + filesArray[loop].class_id + '</p>';
    outHTML += '<p>Added: ' + filesArray[loop].time_added + '</p>';
    outHTML += '<a href="' + filesArray[loop].content_link + '" class="button" >Download</a>';
    outHTML += '<a href="#" class="button" onClick="modalDelFile(' + filesArray[loop].content_id + ')">Delete</a>';
    outHTML += '</div>';
    outHTML += '</div>';
  }
  document.getElementById('filelist').innerHTML = outHTML;
  document.getElementById('userlist').style.display = 'none';
  document.getElementById('edituserform').style.display = 'none';
  document.getElementById('adduserform').style.display = 'none';
}

function modalDelFile(fileid) {
  resetModal();
  document.getElementById('myModal').style.display = "block";
  document.getElementById('modalheadertext').innerHTML = "DELETING A FILE";
  document.getElementById('modaltext').innerHTML = "<p>Are you sure you want to delete this file (content id: " + fileid + ")?</p><button onclick='AJAXdeleteFile(" + fileid + ")'>Yes</button> <button onclick='closeModal()'>Cancel</button>";
}


function AJAXdeleteFile(fileid) {
  var filesURL = "model/webservice.php?getData=deletefile&fileid=" + fileid;
  $.ajax({
    url: filesURL,
    method: 'get',
    datatype: 'json',
    success: function(data) {
      closeModal();
      if(data.status == 'success'){
        modalSuccess();
        document.getElementById('modaltext').innerHTML = "<p>File deleted successfully</p><button onclick='closeModal()'>OK</button>";
        getFiles();
      } 
      if(data.status == 'error'){
        modalError();
        document.getElementById('modaltext').innerHTML = "<p>Error on query</p><button onclick='closeModal()'>OK</button>";
        getFiles();
      }
      if(data.status == 'notfound'){
        modalError();
        document.getElementById('modaltext').innerHTML = "<p>File does not exist, record removed from database</p><button onclick='closeModal()'>OK</button>";
        getFiles();
      }
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

function showPassword2() {
  var p2 = document.getElementById("useraddpw");   
  if (p2.type == "password") {
    p2.type = "text";
  } else {
    p2.type = "password";
  }
}

function showPassword3() {
  var p2 = document.getElementById("usereditpw");   
  if (p2.type == "password") {
    p2.type = "text";
  } else {
    p2.type = "password";
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

function modalBrowser() {
  document.getElementById('myModal').style.display = "block";
  document.getElementById('modaltext').innerHTML = navigator.userAgent;
  document.getElementById('modalheadertext').innerHTML = "BROWSER INFO";
  document.getElementById('modalheader').style.backgroundColor = "grey";
  document.getElementById('modalfooter').style.backgroundColor = "grey";

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

function modalSuccess() {
  document.getElementById('myModal').style.display = "block";
  document.getElementById('modalheadertext').innerHTML = "DONE";
  document.getElementById('modalheader').style.backgroundColor = "green";
  document.getElementById('modalfooter').style.backgroundColor = "green";
}

function modalError() {
  document.getElementById('myModal').style.display = "block";
  document.getElementById('modalheadertext').innerHTML = "ERROR";
  document.getElementById('modalheader').style.backgroundColor = "red";
  document.getElementById('modalfooter').style.backgroundColor = "red";
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
  document.getElementById('modalheader').style.backgroundColor = "green";
  document.getElementById('modalfooter').style.backgroundColor = "green";
  document.getElementById('modaltext').innerHTML = "<p>You have successfully logged in.</p><button onclick='closeModal()'>OK</button>";
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

function validity1() {      
  var gocode = 1;
  if (!useraddun.checkValidity()) {
      document.getElementById("errora1").innerHTML = useraddun.validationMessage;  
      gocode = 0;
  } else {
      errora1.innerHTML = "";
  }
  if (!useraddpw.checkValidity()) {
      document.getElementById("errora2").innerHTML = useraddpw.validationMessage;  
      gocode = 0;  
  } else {
      errora2.innerHTML = "";
  }
  if (!useraddname.checkValidity()) {
      document.getElementById("errora3").innerHTML = useraddname.validationMessage;   
      gocode = 0;  
  } else {
      errora3.innerHTML = "";
  }
  if (!useraddsurname.checkValidity()) {
      document.getElementById("errora4").innerHTML = useraddsurname.validationMessage;  
      gocode = 0;   
  } else {
      errora4.innerHTML = "";
  }
  if (!useraddemail.checkValidity()) {
      document.getElementById("errora5").innerHTML = useraddemail.validationMessage; 
      gocode = 0;    
  } else {
      errora5.innerHTML = "";
  }
  if (gocode == 1) {
    adduser_button_form.disabled = false;
  } else {
    adduser_button_form.disabled = true;
  }
}

function validity2() {      
  var gocode = 1;
  if (!usereditun.checkValidity()) {
      document.getElementById("errore1").innerHTML = usereditun.validationMessage;    
      gocode = 0;  
  } else {
      errore1.innerHTML = "";
  }
  if (!usereditpw.checkValidity()) {
      document.getElementById("errore2").innerHTML = usereditpw.validationMessage;    
      gocode = 0;  
  } else {
      errore2.innerHTML = "";
  }
  if (!usereditname.checkValidity()) {
      document.getElementById("errore3").innerHTML = usereditname.validationMessage;    
      gocode = 0;  
  } else {
      errore3.innerHTML = "";
  }
  if (!usereditsurname.checkValidity()) {
      document.getElementById("errore4").innerHTML = usereditsurname.validationMessage;    
      gocode = 0;  
  } else {
      errore4.innerHTML = "";
  }
  if (!usereditemail.checkValidity()) {
      document.getElementById("errore5").innerHTML = usereditemail.validationMessage;    
      gocode = 0;  
  } else {
      errore5.innerHTML = "";
  }
  if (gocode == 1) {
    edituser_button_form.disabled = false;
  } else {
    edituser_button_form.disabled = true;
  }
}
