<?php
session_start();

$bar = "<ul class='pull-right'>
      <li class='navbar-text'>
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
	header('location:http://localhost/OnlineSchool/ste_includes/login/loginForm.php');
	exit();
	}
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Online School | Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <link href="../ste_content/css/new.css" rel="stylesheet">
    <link href="../ste_content/css/new-responsive.css" rel="stylesheet">
	<link href="../ste_content/css/index.css" rel="stylesheet"> 
	<link href="../ste_content/css/sign_up.css" rel="stylesheet">  
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- Fav icon -->
    <link rel="shortcut icon" href="../ste_content/img/favicon.ico">
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
            
            <a class="brand" href=""><img src="../ste_content/img/exam_icon.jpg" width="200" height="80"/></a>
            
			<div class="nav-collapse collapse">
            <ul class="nav">
            	<li class="active"><a href="http://localhost/OnlineSchool/index.php">Home</a></li>
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


    <!-- Carousel-->
    <!--================================================== -->
    <div id="content">				
	<header class="modal-header" id='model_header'>
		<p class='signUpTxt'>Sign Up</p>
	</header>
  
  <header class="modal-header" >
	  <div id="jkl" style="display:none; color:red;">Please Fill All the Info </div>
	  
	</header>

	<div class="">
		<p>
		<form class="form-horizontal" action="insert.php" method="POST" enctype="multipart/form-data">
			
			<div class="control-group "> 
                <label class="control-label" for="inputName" placeholder="Niloy">First Name</label>
                <div class="controls">
             		<input type="text" id="inputWarning" name="first_name" class="first_name" onblur="return first_name_length();">
           			<span class="help-inline" style="color:red;" id="first_name"></span>
                </div>
            </div>
			
			
			<div class="control-group">
          		<label class="control-label" for="inputName" placeholder="Banik">Last Name</label>
                <div class="controls">
             		<input type="text" id="inputWarning" name="last_name" class="last_name" onblur="return last_name_length();">
           			<span class="help-inline" style="color:red;" id="last_name"></span>
                </div>
            </div>
			
			
			<div class="control-group ">
          		<label class="control-label" for="inputName" placeholder="Niloy123">User Name</label>
                <div class="controls">
            		<input type="text" id="inputWarning" name="user_name" class="user_name" onblur="return check_username_availibility()">
           			<span class="help-inline" style="color:red;" id="user_name">
		     		<img src="" id="username_image_check"/>
		   			<span id="username_check">
		   			</span>
		   			</span>
                </div>
            </div>
			
			
			<div class="control-group">
          		<label class="control-label" for="inputName" placeholder="Email" >E-Mail</label>
                <div class="controls">
             		<input type="email" id="inputWarning" name="email" class="email" onblur="return check_email_availibility();">
           			<span class="help-inline" style="color:red;"id="email">		   
		  			<img src="" id="image_check"/>
		   			<span id="email_check">
		   			</span>
					</span>
                </div>
            </div>
			
  			<div class="control-group">
          		<label class="control-label" for="inputName">Password</label>
                <div class="controls">
             		<input type="password"  id="inputEmail" name="password" class="password" onblur="return password1();">
           			<span class="help-inline" style="color:red;"id="password"></span>
                </div>
            </div>
			
			
  			<div class="control-group">
				<label class="control-label" for="inputPassword">Country</label>
    			<div class="controls">
					<select name="country" class="country" >
				        <option value="choose" disabled='disabled'>Choose a Country</option>
						<option value="Afghanistan">Afghanistan</option>
						<option value="Bangladesh" selected='selected'>Bangladesh</option>
						<option value="India">India</option>
						<option value="Pakistan">Pakistan</option>
						<option value="Sri-Lanka">Sri-Lanka</option>
						<option value="Maldives">Maldives</option>
					</select>
					<span class="help-inline" style="color:red;" id="country"></span>
    			</div>
  			</div>
			
			<div class="control-group">
				<label class="control-label" for="inputPassword">Date Of Birth</label>
    			<div class="controls">
					<select name="day" id="day" style="width:13%;">
						<option disabled='disabled'>Day</option>
						<option value="01">01</option>
						<option value="02">02</option>
						<option value="03">03</option>
						<option value="04">04</option>
						<option value="05">05</option>
						<option value="06">06</option>
						<option value="07">07</option>
						<option value="08">08</option>
						<option value="09">09</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
						<option value="21">21</option>
						<option value="22">22</option>
						<option value="23">23</option>
						<option value="24">24</option>
						<option value="25">25</option>
						<option value="26">26</option>
						<option value="27">27</option>
						<option value="28">28</option>
						<option value="29">29</option>
						<option value="30">30</option>
						<option value="31">31</option>						
					</select>
						&nbsp;&nbsp;&nbsp;&nbsp;
					<select name="Month" id="month" style="width:15%;"> 
						<option disabled='disabled'>Month</option>
						<option value="January">January</option>
						<option value="february">February</option>
						<option value="March">March</option>
						<option value="April">April</option>
						<option value="May">May</option>
						<option value="June">June</option>
						<option value="July">July</option>
						<option value="August">August</option>
						<option value="September">September</option>
						<option value="October">October</option>
						<option value="November">November</option>
						<option value="December">December</option>
					</select>
						&nbsp;&nbsp;&nbsp;&nbsp;
					<select name="year" id="year" style="width:13%;"> 
						<option disabled='disabled'>Year</option>
						<option value="1982">1982</option>
						<option value="1983">1983</option>
						<option value="1984">1984</option>
						<option value="1985">1985</option>
						<option value="1986">1986</option>
						<option value="1987">1987</option>
						<option value="1988">1988</option>
						<option value="1989">1989</option>
						<option value="1990">1990</option>
						<option value="1991">1991</option>
						<option value="1992">1992</option>
						<option value="1993">1993</option>
						<option value="1994">1994</option>
						<option value="1995">1995</option>	
						<option value="1996">1996</option>	
						<option value="1997">1997</option>	
						<option value="1998">1998</option>	
						<option value="1999">1999</option>	
						<option value="2001">2001</option>	
						<option value="2002">2002</option>	
						<option value="2003">2003</option>	
						<option value="2004">2004</option>	
						<option value="2005">2005</option>						
					</select>
					<span class="help-inline" style="color:red;"id="birth"></span>
    			</div>
  			</div>
			
			<div class="control-group">
			
			<label class="control-label" for="inputPassword"> Upload Profile Picture</label>
			<div class="controls">
			<input name="fileField" type="file" id="fileField" />
			<span class="help-inline" style="color:red;"id="file"></span>
			</div>
			</div>

  			<div class="control-group">
    		<div class="controls">
				
			<input type="submit" class="btn btn-primary" id="sign_up" value="Sign Up">
				
    		</div>
  			</div>
		</form>

		</p>
	</div>		
	</div>
   <br/><br/><br/><br/>
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
    <script src="../ste_content/js/sign_up.js"></script>
</body>

</html>
