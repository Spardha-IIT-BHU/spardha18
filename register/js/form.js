function hideError(){
    $('#error').html('');
    $('#error').fadeOut();
}
function showError(error){
    $("#error").fadeIn();
    $("#error").html(error);
    $('html, body').stop().animate( parent.scrollTo(0,0), 1000);
}

$("document").ready(function () {
$("#institute_name").on('change', function() {
    if(this.selectedIndex==621) $('#other_institute_div').fadeIn();
    else $('#other_institute_div').fadeOut();
})
});
function validate(form){
    hideError();
    $("#error").html('');
    if(!$("form #terms").is(":checked")) return false;
    if($("form #institute_name option:selected").is(":disabled")){
        showError("Please select your institute.");
        return false;
    }
    if($("form #institute_name").prop('selectedIndex')==621 && $("form #other_institute").val()==''){
        showError("Please enter the name of your institute.");
        return false;
    }
    if($("form #name").val()==''){
        showError("Please enter your name.");
        return false;
    }
    if($("form #designation").val()==''){
        showError("Please enter your designation.");
        return false;
    }
    var mail = $("form #email").val();
    if(!(mail.split('@').length==2 && mail.split('@')[1].split('.').length>=1)){
        showError("Please enter a valid email id.");
        return false;
    }
    var phoneNo = $("form #phone").val();
    if(!$.isNumeric(phoneNo) || parseInt(phoneNo[0])<6 || phoneNo.length!=10){
        showError("Please enter a valid phone number.");
        return false;
    }
    if($("form .event:checked").length==0){
        showError("Please select at least one event.");
        return false;
    }
    opted="";
    $.each($("form .event:checked"), function(){
        opted+=$(this).attr("id")+",";
    });
    opted=opted.substring(0, opted.length-1);
    $("form #opted_events").val(opted);
    return true;
}