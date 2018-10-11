
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