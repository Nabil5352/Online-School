<?php
session_start();

$bar = "<ul class='pull-right'>
      <li class='navbar-text'>
      </li>
    </ul>
    <ul class='pull-right'>
		<li class='navbar-text'>
		<a href='http://localhost/OnlineSchool/ste_includes/signup/'>Sign Up</a>
		</li>
		</ul>
		<ul class='pull-right'>
		<li class='navbar-text'>
		<a href='#launch' data-toggle='modal'>Log In</a>
		</li>
		</ul>";
$OKbar = "";

if(isset($_SESSION["user"])&& isset($_SESSION["password"])){
	
$user = preg_replace('#[^0-9A-Za-z]#i','',$_SESSION["user"]);
$pass = preg_replace('#[^0-9A-Za-z]#i','',$_SESSION["password"]);

include "../ste_content/connect.php";

$sql = mysql_query("SELECT * from user Where user_name='$user' AND password='$pass' LIMIT 1");

if(mysql_num_rows($sql) > 0){

while($row = mysql_fetch_array($sql)) {
    $id = $row['user_id'];
    $username = $row['user_name'];
	$password = $row['password'];	
	}   
	
if(strcmp($username,$user)==0 && strcmp($password,$pass)==0)
	{
		$OKbar = "				
			  <ul class='pull-right'>
				  <li class='navbar-text'>
				  </li>
				  </ul>         
          <ul class='pull-right'>
          <li class='navbar-text'>   
          <a class='dropdown-toggle' data-toggle='dropdown' id='hi'>&nbsp;Hi&nbsp;$username<b class='caret'></b></a>
          <ul class='dropdown-menu' id='drpdwn'>
          <li><img class='userIMG' src='http://localhost/OnlineSchool/ste_includes/ste_content/img/sign_img/$id.jpg' alt='$username'/></li>
          <li><a href='http://localhost/OnlineSchool/ste_includes/signup/user_profile.php'>Account Settings</a></li>
          <li><a href='http://localhost/OnlineSchool/ste_includes/login/logout.php'>Log Out</a></li>               
          </ul>
          </li>
          </ul>
          ";
		$bar = "";
	}
}
}
else{
header('location:http://localhost/OnlineSchool/ste_includes/login/loginForm.php');
exit();
}
?>
<?php

$xmSQL = mysql_query("SELECT * FROM `subcategory` ORDER BY `Category_id`");
$xmSubject = "";

while($row = mysql_fetch_array($xmSQL)){
	$subcategoryID = $row['Subcategory_id'];
	$subcategoryName = $row['Subcategory_name'];

	$xmSubject .= "<p class='subjctList'><input class='input1' type='radio' name='choose' value='$subcategoryID'> &nbsp;&nbsp;$subcategoryName <p>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Online School | Exam Center</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../ste_content/css/new.css" rel="stylesheet">
    <link href="../ste_content/css/new-responsive.css" rel="stylesheet">
	<link href="../ste_content/css/index.css" rel="stylesheet">  
   	<link href="../ste_content/css/jquery.css" rel="stylesheet">  	
    <link href="../ste_content/css/exam.css" rel="stylesheet">   
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav icon -->
    <link rel="shortcut icon" href="../ste_content/img/favicon.ico">
</head>

<body>
<span id="example" style="display:none;">Please Choose A type</span>
<section id="launch" class="modal hide fade">
	<header class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h3 align="center">Log In</h3>
	</header>

	<div class="modal-body">
		<p>
		<form class="form-horizontal" action="http://localhost/OnlineSchool/ste_includes/login/index.php" method="POST">
			
			<p align="center"><b>Don't have an account?</b> <a href="http://localhost/OnlineSchool/ste_includes/signup/">Sign Up</a></p>
			<div class="control-group">
				<label class="control-label" for="inputName">Username</label>
			<div class="controls">
				<input type="text" id="inputName" name="username" placeholder="Username">
			</div>
			</div>
			
  			<div class="control-group">
				<label class="control-label" for="inputPassword">Password</label>
    		<div class="controls">
				<input type="password" id="inputPassword" name="password" placeholder="Password">
    		</div>
  			</div>
			
  			<div class="control-group">
    		<div class="controls">
				<label class="checkbox">
					<input type="checkbox"> Remember me
				</label>
				<button type="submit" class="btn btn-primary">Sign in</button>
				
    		</div>
  			</div>
		</form>
		</p>
	</div>
	<footer class="modal-footer">
		<button class="btn" data-dismiss="modal">Close</button>
	</footer>
</section>

    <!-- NAVBAR -->
    <!-- ================================================== -->
<div class="navbar-wrapper">
	<div class="container">
		<div class="navbar navbar-inverse">
		<div class="navbar-inner">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </a>
            
            <a class="brand" href=""><img src="../ste_content/img/exam_icon.jpg" width="200" height="80"/></a>
            
			<div class="nav-collapse collapse">
            <ul class="nav">
            	<li class="active"><a href="http://localhost/OnlineSchool/">Home</a></li>
				<li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Tutorial<b class="caret"></b></a>
            		<ul class="dropdown-menu">
                		<li><a href="http://localhost/OnlineSchool/ste_includes/video.php">Video</a></li>
                		<li><a href="http://localhost/OnlineSchool/ste_includes/tuto.php">Article</a></li>
            		</ul>
				</li>
				
				<li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Exam<b class="caret"></b></a>
             		<ul class="dropdown-menu">
                		<li><a href="http://localhost/OnlineSchool/ste_includes/exam/">Test yourself</a></li>
                		<li><a href="http://localhost/OnlineSchool/ste_includes/results/">Result Archive</a></li>
             		</ul>
				</li>
				
				<li><a href="http://localhost/OnlineSchool/ste_includes/forum/index.php">Forum</a></li>
				
                <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Misc.<b class="caret"></b></a>
             		<ul class="dropdown-menu">
                		<li><a href="#about">About</a></li>
                		<li><a href="#contact">Contact</a></li>
             		</ul>
				</li>           
            </ul>
            <?php 
				echo $bar;
				echo $OKbar; 
			?>
        </div>
        </div>
	</div>	  
</div>

<form action="questions.php" Method="POST">
<div id="bod">
  <div id="left_body">
  	<div class="hero_unit">
        <p class='titleTxt'>Exam Center</p>
        <p class='subTxt'>Choose a subject</p>		
		<?php echo $xmSubject; ?>
        <a class="btn btn-primary btn-large" id="go_button">Go</a>
        </p>
   </div>
</div>

<div id="right_body">
	<div class="modal_header">          
	<p class='titleTxt'>Choose a type</p>
	</div>

	<div class="modal_body">
	<p><input class="input1" type="radio" name="choose1" value="b">&nbsp;&nbsp;Begginer</p>
	<p><input class="input1" type="radio" name="choose1" value="a">&nbsp;&nbsp;Advanced</p>
	<p><input class="input1" type="radio" name="choose1" value="e">&nbsp;&nbsp;Experts</p>
	</div>
	<div class="modalfooter">
	<button class="btn btn-info" type="submit" id="button">Start Exam </button>
	</div>
</div>
</form>

</div>
</div>

    <!-- javascript -->
    <!-- ================================================== -->
    <script src="../ste_content/js/jquery.js"></script>
    <script src="../ste_content/js/new-transition.js"></script>
    <script src="../ste_content/js/new-alert.js"></script>
    <script src="../ste_content/js/new-modal.js"></script>
    <script src="../ste_content/js/new-dropdown.js"></script>
    <script src="../ste_content/js/new-scrollspy.js"></script>
    <script src="../ste_content/js/new-tab.js"></script>
    <script src="../ste_content/js/new-tooltip.js"></script>
    <script src="../ste_content/js/new-popover.js"></script>
    <script src="../ste_content/js/new-button.js"></script>
    <script src="../ste_content/js/new-collapse.js"></script>
    <script src="../ste_content/js/new-carousel.js"></script>
    <script src="../ste_content/js/new-typeahead.js"></script>
	<script src="../ste_content/js/jquery-ui.js"></script>
    <script>
	  	$('document').ready(function(){
	  $('#right_body').hide();
	  $('#left_body').css('width','100%');
	  var input=0;
	   $('#go_button').attr('disabled','true');
	  
	  $('.input1').click(function(){
	   $('#go_button').removeAttr('disabled');
	   var input=1;
	
	});
	  
	  $('#go_button').click(function(){
	 if ($('.input1').is(':checked')){
	   $('#left_body').animate({
   
	width: '40%'
    
  },700, function() {
    $('#right_body').show("puff",  1000); // Animation complete.
  });
	  }
	  });
	   
	  });
	
	
	   !function ($) {
        $(function(){
          $('#myCarousel').carousel()
        })
      }(window.jQuery)
	  
	  $('.profile').hover(function(){
	  $('#a').show(400);
	  
	  });
	  $('#a','.navbar-wrapper').mouseleave(function(){
	  $('#a').hide(400);
	  
	  });  	  
    </script>
</body>

</html>