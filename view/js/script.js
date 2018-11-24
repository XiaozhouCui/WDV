// get last login name from local storage
window.onload = function() {
  if(document.getElementById('login_username') != null) {
    if(localStorage.getItem("username") != null) {
      document.getElementById('login_username').value = localStorage.getItem('username')
    }
  }
}

function rememberValue() {  
  var lu = document.getElementById('login_username').value;
  if (lu == "") {
    document.getElementById("login_username").innerHTML = localStorage.getItem("username");
  } else {
    localStorage.setItem("username", lu);
  }   
}

// Toggle side bar
function openNav() {
  document.getElementById("mySidebar").style.display = 'block';  
}

function closeNav() {
  document.getElementById("mySidebar").style.display = 'none';  
}

function addUserForm() {
  document.getElementById("adduserform").reset();
  document.getElementById('adduserform').style.display = 'block';
  document.getElementById('userlist').style.display = 'none';
  document.getElementById('filelist').style.display = 'none';
  document.getElementById('edituserform').style.display = 'none';
  document.getElementById('dzone').style.display = 'none';
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
  document.getElementById('userlist').style.display = 'block';
  document.getElementById('filelist').style.display = 'none';
  document.getElementById('edituserform').style.display = 'none';
  document.getElementById('adduserform').style.display = 'none';
  document.getElementById('dzone').style.display = 'none';
  $('#userlist').html('<img src="view/images/flaskloader.svg"/>');  //show SVG loading animation effect
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
      modalSuccess();
      document.getElementById('modaltext').innerHTML = "<p>User updated successfully</p><button class='btn btn-secondary btn-block btn-lg' onclick='closeModal()'>OK</button>";
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
  document.getElementById('modaltext').innerHTML = '<form action="?pageid=deletinguser" method="post">	<p>Are you sure you wan to delete this account (login id: ' + loginid + ')?</p> <input type="hidden" name="rowid" value="' + loginid + '"><br> <input type="submit" value="Yes"> <input type="button" onclick="closeModal()" value="Cancel" /> </form>';
}

function AJAXdeleteUser(userid) {
  var userURL = "model/webservice.php?getData=deleteuser&userid=" + userid;
  $.ajax({
    url: userURL,
    method: 'get',
    datatype: 'json',
    success: function() {
      modalSuccess();
      document.getElementById('modaltext').innerHTML = "<p>User deleted successfully</p><button class='btn btn-secondary btn-block btn-lg' onclick='closeModal()'>OK</button>";
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
  document.getElementById('userlist').style.display = 'none';
  document.getElementById('edituserform').style.display = 'none';
  document.getElementById('adduserform').style.display = 'none';
  document.getElementById('dzone').style.display = 'none';
  $('#filelist').html('<img src="view/images/flaskloader.svg"/>');  //show SVG loading animation effect
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
}

function modalDelFile(fileid) {
  resetModal();
  document.getElementById('myModal').style.display = "block";
  document.getElementById('modalheadertext').innerHTML = "DELETING A FILE";
  document.getElementById('modaltext').innerHTML = "<p>Are you sure you want to delete this file (content id: " + fileid + ")?</p><button onclick='AJAXdeleteFile(" + fileid + ")'>Yes</button> <button class='btn btn-secondary btn-block btn-lg' onclick='closeModal()'>Cancel</button>";
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
        document.getElementById('modaltext').innerHTML = "<p>File deleted successfully</p><button class='btn btn-secondary btn-block btn-lg' onclick='closeModal()'>OK</button>";
        getFiles();
      } 
      if(data.status == 'error'){
        modalError();
        document.getElementById('modaltext').innerHTML = "<p>Error on query</p><button class='btn btn-secondary btn-block btn-lg' onclick='closeModal()'>OK</button>";
        getFiles();
      }
      if(data.status == 'notfound'){
        modalError();
        document.getElementById('modaltext').innerHTML = "<p>File does not exist, record removed from database</p><button class='btn btn-secondary btn-block btn-lg' onclick='closeModal()'>OK</button>";
        getFiles();
      }
    },
    error: function(err) {
      console.log(err);
    }
  });
}

function showPassword1() {
  var p1 = document.getElementById("password01");   
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
  var p3 = document.getElementById("trainerpw");   
  if (p3.type == "password") {
    p3.type = "text";
  } else {
    p3.type = "password";
  }
}

function doUsernameCheck(userName) {     
  var ajaxUrl = 'model/webservice.php?getData=checkreg&username=' + userName;
  $.ajax({
    type: 'get',
    url: ajaxUrl,
    dataType: 'json',
    success: function(data) {
      if (data.status == 'taken' ) {
        var thisName = userName;
        $('#errmsg01').css('color', 'red');
        $('#errmsg01').html("Username <strong>"+ thisName +"</strong> already taken");
        submitform01.disabled = true;
      }
      if (data.status == 'ok' ) {
        $('#errmsg01').html("");
        submitform01.disabled = false;
      }
    },
    error: function(err) {
      console.log(err);
    }
  });
}

function doEmailCheck(emailAddr) {     
  var ajaxUrl = 'model/webservice.php?getData=checkreg&email=' + emailAddr;
  $.ajax({
    type: 'get',
    url: ajaxUrl,
    dataType: 'json',
    success: function(data) {
      if(data.status == 'taken') {
        var thisEmail = emailAddr;
        $('#errmsg02').css('color', 'red');
        $('#errmsg02').html("<strong>"+ thisEmail +"</strong> already taken");
        submitform01.disabled = true;
      } 
      if (data.status == 'ok') {
        $('#errmsg02').html("");
        submitform01.disabled = false;
      }
    },
    error: function(err) {
      console.log(err);
    }
  });
}

function listTrainers() {
  var getUrl = 'model/webservice.php?getData=listtrainer';
  var htmlCode = '';
  $.ajax({
    type: 'get',
    url: getUrl,        
    dataType: 'json',
    success: function(msg) {
      for(var loop = 0; loop<msg.length; loop++) {
        htmlCode += '<option value="' + msg[loop].trainer_id + '">' +  msg[loop].trainer_id + ' - ' +
        msg[loop].name + ' ' + msg[loop].surname + '</option>';
      }
      $("#trainer_list").html(htmlCode);
    }
  });
}

function setTrainer() {
  document.getElementById('trainerid').value = document.getElementById('trainer_list').value;
}

function listCourses() {
  var getUrl = 'model/webservice.php?getData=listcourse';
  var htmlCode = '';
  $.ajax({
    type: 'get',
    url: getUrl,        
    dataType: 'json',
    success: function(msg) {
      for(var loop = 0; loop<msg.length; loop++) {
        htmlCode += '<option value="' + msg[loop].course_id + '">' +  msg[loop].course_id + ' - ' +
        msg[loop].course_name + '</option>';
      }
      $("#course_list").html(htmlCode);
    }
  });
}

function setCourse() {
  document.getElementById('courseid').value = document.getElementById('course_list').value;
}

function showModal() {
  resetModal();
  document.getElementById('myModal').style.display = "block";
}

function closeModal() {  
  document.getElementById('myModal').style.display = "none";
}

function resetModal() {
  document.getElementById('modaltext').innerHTML = "Content";
  document.getElementById('modalheadertext').innerHTML = "Modal Header";
  document.getElementById('modalheader').style.backgroundColor = "rgb(77, 118, 255);";
  document.getElementById('modalfooter').style.backgroundColor = "rgb(77, 118, 255);";
}

function modalBrowser() {
  resetModal();
  document.getElementById('myModal').style.display = "block";
  document.getElementById('modaltext').innerHTML = navigator.userAgent + "<p><button class='btn btn-secondary btn-lg' onclick='closeModal()'>OK</button></p>";
  document.getElementById('modalheadertext').innerHTML = "BROWSER INFO";
}

function modalSuccess() {
  resetModal();
  document.getElementById('myModal').style.display = "block";
  document.getElementById('modalheadertext').innerHTML = "DONE";
  document.getElementById('modalheader').style.backgroundColor = "green";
  document.getElementById('modalfooter').style.backgroundColor = "green";
}

function modalError() {
  resetModal();
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
  modalSuccess() 
  document.getElementById('modalheadertext').innerHTML = "WELCOME";
  document.getElementById('modaltext').innerHTML = "<p>You have successfully logged in.</p><p><div id='countdown'></div></p><a class='btn btn-secondary btn-block btn-lg' href='?pageid=loggedin'>Skip</a>";
}

function redirect(){
  if (seconds <=0){
  // redirect to new url after counter  down.
    window.location = "?pageid=loggedin";
  } else {
    seconds--;
    document.getElementById("countdown").innerHTML = " Redirect after <strong>"+seconds+"</strong> seconds."
    setTimeout("redirect()", 1000)
  }
}

function loginFailed() {
  modalError();
  document.getElementById('modalheadertext').innerHTML = "Login Failed";
  document.getElementById('modaltext').innerHTML = "<p>Sorry, either your username or your password is incorrect</p><button class='btn btn-secondary btn-block btn-lg' onclick='closeModal()'>OK</button>";
}

function modalLogout() {
  resetModal();
  document.getElementById('myModal').style.display = "block";
  document.getElementById('modaltext').innerHTML = "<p>You have successfully logged out</p><a class='btn btn-secondary btn-block btn-lg' href='index.php'>OK</a>";
  document.getElementById('modalheadertext').innerHTML = "GOOD BYE";
}

// modal button calling AJAX to delete user
function modalDelUser(userid) {
  modalError();
  document.getElementById('modalheadertext').innerHTML = "WARNING! DELETING A USER"
  document.getElementById('modaltext').innerHTML = "<p>Are you sure you want to delete this user (login id: " + userid + ")?</p><p><button class='btn btn-secondary btn-lg' onclick='AJAXdeleteUser(" + userid + ")'>Yes</button>  <button class='btn btn-secondary btn-lg' onclick='closeModal()'>Cancel</button></p>";
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

function list_image() {
  $.ajax({
    url:"controller/dzone.php",
    success:function(data) {
      $('#preview').html(data);
    }
  });
}

// disabling form submissions if there are invalid fields
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

function showDropzone() {
  document.getElementById('dzone').style.display = 'block';
  document.getElementById('adduserform').style.display = 'none';
  document.getElementById('userlist').style.display = 'none';
  document.getElementById('filelist').style.display = 'none';
  document.getElementById('edituserform').style.display = 'none';
  $(document).ready(function(){
    Dropzone.options.dropzoneFrom = {
      autoProcessQueue: false,
      acceptedFiles:".png,.jpg,.gif,.bmp,.jpeg",
      init: function(){
        var submitButton = document.querySelector('#submit-all');
        myDropzone = this;
        submitButton.addEventListener("click", function(){
        myDropzone.processQueue();
        });
        this.on("complete", function(){
          if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
            var _this = this;
            _this.removeAllFiles();
          }
          list_image();
        });
      },
    };
   
    list_image();
   
    $(document).on('click', '.remove_image', function(){
      var name = $(this).attr('id');
      $.ajax({
        url:"controller/dzone.php",
        method:"POST",
        data:{name:name},
        success:function(data) {
          list_image();
        }
      })
    });
  });
}