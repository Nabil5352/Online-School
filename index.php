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

include "ste_includes/ste_content/connect.php";

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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Online School | Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	
    <link href="ste_includes/ste_content/css/new.css" rel="stylesheet">
    <link href="ste_includes/ste_content/css/new-responsive.css" rel="stylesheet">
	<link href="ste_includes/ste_content/css/index.css" rel="stylesheet">   

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav icon -->
    <link rel="shortcut icon" href="ste_includes/ste_content/img/favicon.ico">
</head>

<body>

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
            <a class="brand" href="http://localhost/OnlineSchool/index.php"><img src="ste_includes/ste_content/img/os_icon.jpg" width="200" height="80"/></a>
            
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
				
				<li><a href="http://localhost/OnlineSchool/ste_includes/forum/">Forum</a></li>
				
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
	  
    </div>



    <!-- Carousel-->
    <!--================================================== -->
	<fieldset class="borderCar">
    <div id="myCarousel" class="carousel slide">
      <div class="carousel-inner">
        <div class="item active">
          <img src="ste_includes/ste_content/img/slide1.jpg" alt="">
          <div class="container">
            <div class="carousel-caption">
              <h1>Video</h1>
              <p class="lead"> Browse thousand of video tutorial and more than twenty playlist. Watch and learn how to master on several programming language including JAVA, PHP and C#.</p>
              <a class="btn btn-small btn-primary" href="http://localhost/OnlineSchool/ste_includes/video.php">Browse playlist</a>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="ste_includes/ste_content/img/slide2.jpg" alt="">
          <div class="container">
            <div class="carousel-caption">
              <h1>Tutorial</h1>
              <p class="lead">We wrapped complex topics with simple wrapper and present it to you. Experts made this tutorial as easy as it can be. This tutorial makes your basic skill much stronger.</p>
              <a class="btn btn-small btn-primary" href="http://localhost/OnlineSchool/ste_includes/tuto.php">Browse tutorials</a>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="ste_includes/ste_content/img/slide3.jpg" alt="">
          <div class="container">
            <div class="carousel-caption">
              <h1>Forum</h1>
              <p class="lead"> There is no such thing as "stupid" questions. Ask your questions what you need to know and Share your knowledge what you already know.</p>
              <a class="btn btn-small btn-primary" href="http://localhost/OnlineSchool/ste_includes/forum/">Visit forum</a>
            </div>
          </div>
        </div>
		<div class="item">
          <img src="ste_includes/ste_content/img/slide4.jpg" alt="">
          <div class="container">
            <div class="carousel-caption">
              <h1>Exam Center</h1>
              <p class="lead"> Exam helps you to test your own skill. </p>
              <a class="btn btn-small btn-primary" href="http://localhost/OnlineSchool/ste_includes/signup/">Sign up today</a>
            </div>
          </div>
        </div>
		<div class="item">
          <img src="ste_includes/ste_content/img/slide5.jpg" alt="">
          <div class="container">
            <div class="carousel-caption">
              <h1>Result Archive</h1>
              <p class="lead"> You can save your exam result in our database to see your daily improvement and get experts advice via e-mail. </p>
              <a class="btn btn-small btn-primary" href="http://localhost/OnlineSchool/ste_includes/login/loginForm.php">Learn more</a>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div>
	</fieldset>



    <!-- Features -->
    <!-- ================================================== -->

    <div class="container marketing">
      <div class="row">
        <div class="span4">
          <p><b>&quot;I hear and I forget. I see and I remember.<br/>I do and I understand.&quot;</b></p>
		  <p><small> &#45;&#45; Confucius &#45;&#45; </small></p>
        </div>
        <div class="span4">
          <p><b>&quot;Imagination is more important than reason.&quot;</b></p>
		  <p><small> &#45;&#45; Einstein &#45;&#45; </small></p>
        </div>
        <div class="span4">
          <p><b>&quot;Do not only practice your art,<br/>but force your way into it's secret&quot;</b></p>
		  <p><small> &#45;&#45; Ludwig van beethoven &#45;&#45; </small></p>
        </div>
      </div>
		<hr/><hr/>
     

    </div>
	<div class="footer" align="center">
	 <!-- FOOTER -->
	 <fieldset>
      <footer align="center" style="background-color:#27292a; height:40px;">
       <p> <span class="footer_text">&copy; 2012 Online School.</span> &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>
	  </fieldset>
	</div>



    <!-- javascript -->
    <!-- ================================================== -->

    <script src="ste_includes/ste_content/js/jquery.js"></script>
    <script src="ste_includes/ste_content/js/new-transition.js"></script>
    <script src="ste_includes/ste_content/js/new-alert.js"></script>
    <script src="ste_includes/ste_content/js/new-modal.js"></script>
    <script src="ste_includes/ste_content/js/new-dropdown.js"></script>
    <script src="ste_includes/ste_content/js/new-scrollspy.js"></script>
    <script src="ste_includes/ste_content/js/new-tab.js"></script>
    <script src="ste_includes/ste_content/js/new-tooltip.js"></script>
    <script src="ste_includes/ste_content/js/new-popover.js"></script>
    <script src="ste_includes/ste_content/js/new-button.js"></script>
    <script src="ste_includes/ste_content/js/new-collapse.js"></script>
    <script src="ste_includes/ste_content/js/new-carousel.js"></script>
    <script src="ste_includes/ste_content/js/new-typeahead.js"></script>
    <script>
      !function ($) {
        $(function(){
          $('#myCarousel').carousel()
        })
      }(window.jQuery)
    </script>
</body>

</html>
