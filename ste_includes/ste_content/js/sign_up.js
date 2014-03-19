$('document').ready(function(){

$('#image_check').hide();
});


function password1(){
var password = $(".password").val();

 if (password==""){
 $(".password").css('border','1px solid red');
 $("#password").text('cannot Be empty');
 return false;
 }
	if(password.length <3){
	$(".password").css('border','1px solid red');
	$("#password").text('Must Have 3 Characters');
	return false;
	}
else{
$("#password").text('');
 $(".password").css('border','1px solid grey');
}



}

function first_name_length(){
var first_name = $(".first_name").val();
 
 if (first_name==""){
 $(".first_name").css('border','1px solid red');
 $("#first_name").text('cannot Be empty');
 return false;
 }
	if(first_name.length <3){
	$(".first_name").css('border','1px solid red');
	$("#first_name").text('Must Have 3 Characters');
	return false;
	}
else{
$("#first_name").text('');
 $(".first_name").css('border','1px solid grey');
}
}
function last_name_length(){
var last_name = $(".last_name").val();

if (last_name==""){
 $(".last_name").css('border','1px solid red');
 $("#last_name").text('cannot Be empty');
 return false;
 }
	if(last_name.length <3){
	$(".last_name").css('border','1px solid red');
	$("#last_name").text('Must Have 3 Characters');
	return false;
	}
  else{
  $("#last_name").text('');
   $(".last_name").css('border','1px solid grey');
  }
}



function check_email_availibility(){
var email=$(".email").val();

if(email==""){
  $(".email").css('border','1px solid red');
   $('#image_check').hide();
$('#email_check').text('cannot be empty').css('color','red');
return false;
}

$.post('email_availibilty.php',{email:email},function(data){

       if(data.message=='worked'){
      $('#email_check').text('Not Available').css('color','red');
	  $('#image_check').attr('src','http://localhost/OnlineSchool/ste_includes/ste_content/img/no.jpg');
	   $('#image_check').show();
	   return false;
          }

else{
$(".email").css('border','1px solid grey');
$('#email_check').text(' Available').css('color','green');
 $('#image_check').attr('src','http://localhost/OnlineSchool/ste_includes/ste_content/img/yes.jpg');
 $('#image_check').show();
}



},'json');

}
function check_username_availibility()
{

var user_name=$(".user_name").val();

if(user_name==""){
 $('#image_check').hide();
$('#username_check').text('cannot be empty').css('color','red');
$(".user_name").css('border','1px solid red');
return false;
}

$.post('username_availibilty.php',{user_name:user_name},function(data){

       if(data.message=='worked'){
      $('#username_check').text('Not Available').css('color','red');
	  $('#username_image_check').attr('src','http://localhost/OnlineSchool/ste_includes/ste_content/img/no.jpg');
	   $('#username_image_check').show();
	   return false;
          }

else{
$(".user_name").css('border','1px solid grey');
      $('#username_check').text('Available').css('color','green');
	  $('#username_image_check').attr('src','http://localhost/OnlineSchool/ste_includes/ste_content/img/yes.jpg');
	   $('#username_image_check').show();
}

},'json');

}

$('#sign_up').click(function(){
$("#first_name").text('');
$("#last_name").text('')
$("#username_check").text('');
$("#email").text('');
$("#password").text('');
$("#file").text('');
$('#birth').text('');
$('#country').text('');

	var first_name=$('.first_name').val();
	var last_name=$('.last_name').val();
	var user_name=$('.user_name').val();
	var email=$('.email').val();
	var password=$('.password').val();
	var input = $("input:file").val();
	var day = $('#day').val();
	var month = $('#month').val();
	var year = $('#year').val();
	var country= $('.country').val();
	
	if(first_name==""){
	$("#first_name").text("Cannot Be Empty");
	$("#first_name").hide();
	}
	if(last_name==""){
	$("#last_name").text("Cannot Be Empty");
	$("#last_name").hide();
	}
	if(user_name==""){
	$('#username_check').text('cannot be empty').css('color','red');
    
	}
	if(email==""){
	$("#email").text("Cannot Be Empty");
	$("#email").hide();
	}
	if(password==""){
	$("#password").text("Cannot Be Empty");
	$("#password").hide();
	}
	if(country=="choose"){
    $('#country').text('Please Choose a Country');
	$("#country").hide();
	}
	
	    if(day=="day" || month=="month" || year=="year"){
    $('#birth').text('Select Your Birthday');
	
}


	    if(input==""){
    $('#file').text('Upload An Image');
	
}
	
	
	
if(first_name!="" && last_name!="" && user_name!="" && email!="" && password!="" && input!="" && (day!="day" || month!="month" || year!="year") && country!="choose"){
	$.post('username_availibilty.php',{user_name:user_name},function(data){

       if(data.message=='worked'){
      $('#username_check').text('Not Available').css('color','red');
	  $('#username_image_check').attr('src','http://localhost/OnlineSchool/ste_includes/ste_content/img/no.jpg');
	   $('#username_image_check').show();
	   return false;
          }

else{
$(".user_name").css('border','1px solid grey');
      $('#username_check').text('Available').css('color','green');
	  $('#username_image_check').attr('src','http://localhost/OnlineSchool/ste_includes/ste_content/img/yes.jpg');
	   $('#username_image_check').show();
}



},'json');
}
else{
	$('#first_name').show();
	$('#last_name').show();
	$('#username_check').show();
	$('#email').show();
	$('#password').show();
    $('#birth').show();
	$('#country').show();
var country= $('.country').val();
if(country=="choose"){
$('#country').text('Please Choose a Country');
return false;
}

var input = $("input:file").val();
if(input==""){
$('#file').text('Upload An Image');
return false;
}

var first_name= $('.first_name').val();
if(first_name==""){
$('#first_name').text('Cannot Be Empty');
return false;
}

var last_name= $('.last_name').val();
if(last_name==""){
$('#last_name').text('Cannot Be Empty');
return false;
}

var password= $('.password').val();
if(password==""){
$('#password').text('Cannot Be Empty');
return false;
}
 
 var email= $('.email').val();
if(email==""){
$('#email').text('Cannot Be Empty');
return false;
}
 
 var user_name= $('.user_name').val();
if(user_name==""){
$('#user_name_check').text('Cannot Be Empty');
return false;
} 

}
		var first_name1 = first_name.match(/[\W]/);
		var last_name1 = last_name.match(/[\W]/);
		var user_name1 = user_name.match(/[\W]/);
		var password1 = password.match(/[\W]/);

    if(first_name1 != null){
      $('#first_name').text('Contain Invalid Characters');
      $("#first_name").hide();
    }
	 if(last_name1 != null){
      $('#last_name').text('Contain Invalid Characters');
	 $("#last_name").hide();
    }
	 if(user_name1 != null){
      $('#username_check').text('Contain Invalid Characters');
	$("#username_check").hide();
    } 
	
	
	 if(password1 != null){
      $('#password').text('Contain Invalid Characters');
	  $("#password").hide();
    }
	    			
	if(first_name1==null && last_name1==null && user_name1==null && email1==null && password1==null){	
}
else{
	$('#first_name').show();
	$('#last_name').show();
	$('#username_check').show();
	
	$('#password').show();
	var input = $("input:file").val();
    if(input==""){
    $('#file').text('fgfdsgfs');
}
	
var country= $('.country').val();
if(country=="choose")
$('#country').text('Please Choose a Country');
return false;

}

if(day=="day" || month=="month" || year=="year"){
$('#birth').text('Select your Birthday');
return false;
}
});