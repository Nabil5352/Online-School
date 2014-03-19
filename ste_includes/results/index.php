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
date_default_timezone_set('GMT');

$result = "";

$sql = mysql_query("SELECT * FROM `result_archive` WHERE `user_id`='$id' ORDER BY `date_of_exam`");

if(mysql_num_rows($sql) > 0){

while($row = mysql_fetch_array($sql)) {
	$user_id = $row['user_id'];
    $exam_id = $row['exam_id'];
	$total_marks = $row['total_marks'];
	$obtained_marks = $row['obtained_marks'];
	$date_of_exam = strftime("%b %d, %Y",strtotime($row["date_of_exam"]));

	$USERsql = mysql_query("SELECT * FROM `user` WHERE `user_id`='$id'");
	while ($row = mysql_fetch_array($USERsql)) {
	$userName = $row['user_name'];
	}
	
	$exam_name = $exam_id/10;

	$subjectQuery = mysql_query("SELECT * FROM `subcategory` WHERE `Subcategory_id`='$exam_name'");

	while($row = mysql_fetch_array($subjectQuery)){
		$SubjectName = $row['Subcategory_name'];
	}

	$str_Pattern =  '/[^0-9]*$/';
	preg_match($str_Pattern, $exam_id, $results);

	if($results[0] == 'a'){
		$level = "Advanced";
		}
	else if($results[0] == 'b'){
		$level = "Beginner";
		}
	else if($results[0] == 'e'){
		$level = "Experts";
	}

	$result .= "<table width='85%' border='0' cellpadding='6' align='center'>
			   		<tr>
			   			<td width='104' align='center'>$userName</td>
						<td width='180' align='center'>$SubjectName ($level)</td>
						<td width='104' align='center'>$total_marks</td>
						<td width='104' align='center'>$obtained_marks</td>
						<td width='104' align='center'>$date_of_exam</td>
				    </tr>
			 	</table>";	
	}
}
else{
	$result = "<b><i><h3 align='center'>You do not save any exam result in our database yet.</h3></i></b>";
	}
mysql_close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Online School | Result Archive</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../ste_content/css/new.css" rel="stylesheet">
    <link href="../ste_content/css/new-responsive.css" rel="stylesheet">
	<link href="../ste_content/css/index.css" rel="stylesheet">  
   	<link href="../ste_content/css/jquery.css" rel="stylesheet">  	   
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
		
		<div id="content">
		<table width="85%" border="1" cellpadding="6" align="center">
   		   <tr>
   		    <td width="104" align='center'>User Name</td>
			<td width="180" align='center'>Exam Topic</td>
			<td width="104" align='center'>Total marks</td>
			<td width="104" align='center'>Obtained marks</td>
			<td width="104" align='center'>Date of exam</td>
	       </tr>
		</table>
		<?php echo $result; ?>
		
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
</body>

</html>