function showPassword1() {
  var p1 = document.getElementById("regpw");   
  if (p1.type == "password") {
    p1.type = "text";
  } else {
    p1.type = "password";
  }
}

function showPassword2() {
  var p2 = document.getElementById("userpw");
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

function showPassword4() {
  var p4 = document.getElementById("studentpw");
  if (p4.type == "password") {
    p4.type = "text";
  } else {
    p4.type = "password";
  }
}

function showPassword5() {
  var p5 = document.getElementById("customerpw");
  if (p5.type == "password") {
    p5.type = "text";
  } else {
    p5.type = "password";
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