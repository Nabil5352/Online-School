<?php
session_start();

$bar = "<ul class='pull-right'>
    </ul>
    <ul class='pull-right'>	
		<a href='http://localhost/OnlineSchool/ste_includes/signup/'>Sign Up</a>	
		&#8226;
		<a href='#launch' data-toggle='modal'>Log In</a>
		</ul>";
$OKbar = "";

if(isset($_SESSION["user"])&& isset($_SESSION["password"])){
	
$user = preg_replace('#[^0-9A-Za-z]#i','',$_SESSION["user"]);
$pass = preg_replace('#[^0-9A-Za-z]#i','',$_SESSION["password"]);

include "ste_content/connect.php";

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
				  &nbsp;&nbsp;
				  </ul>         
          <ul class='pull-right'>  
          <a id='hi'>&nbsp;Hi&nbsp;$username</a>
          <img class='brdUsrIMG' src='http://localhost/OnlineSchool/ste_includes/ste_content/img/sign_img/$id.jpg' alt='$username'/>
          </ul>
          ";
		$bar = "";
	}
}
}
?>
<?php

	include "ste_content/connect.php";
	
	//initialize
	$subID = $_GET['Subcategory_id'];
	$tutoID = $_GET['Tuto_id'];
	$ive = '';
	
	$tsSQL = "SELECT * FROM `tuto` WHERE `Tuto_id`='$tutoID'";
	$ts = mysql_query($tsSQL);
	
	while($row = mysql_fetch_array($ts)){
	$tut = $row['Tuto_title'];
	$strDESC = $row['Tuto_desc'];
	}


	
	mysql_close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Online School | Readlist </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	
    <link href="ste_content/css/new.css" rel="stylesheet">
    <link href="ste_content/css/new-responsive.css" rel="stylesheet">
	<link href="ste_content/css/index.css" rel="stylesheet">
	<link href="ste_content/css/video.css" rel="stylesheet">	
	<link href="ste_content/css/reader.css" rel="stylesheet">	

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav icon -->
    <link rel="shortcut icon" href="ste_content/img/favicon.ico">
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
				<button type="submit" class="btn btn btn-primary">Sign in</button>
				
    		</div>
  			</div>
		</form>
		</p>
	</div>
	<footer class="modal-footer">
		<button class="" data-dismiss="modal">Close</button>
	</footer>
</section>


<div class="container-fluid">
	<div class="row-fluid">
		<nav class="span12">
			<ul class="breadcrumb">
			<li><a href="http://localhost/OnlineSchool/index.php" title="Home"><span class="brd_name">Home</span></a>
			<span class="divider">&#187;</span></li>
			<li><a href="http://localhost/OnlineSchool/ste_includes/tuto.php" title="Tutorials"><span class="brd_name">Tutorials</span></a>
			<span class="divider">&#187;</span></li>
			<li><a href="http://localhost/OnlineSchool/ste_includes/tuto_list.php?Subcategory_id=<?php echo $subID; ?>" title="Readlist"><span class="brd_name">Readlist</span></a>
			<span class="divider">&#187;</span></li>
			<li class="active">Reading</li>			
			<?php 
				echo $bar;
				echo $OKbar; 
			?>	
			</ul>
			
		</nav>
	</div>
	</div>
	
	<div class="container">
	<div class="generate">
	<a href="#" title="Generate PDF"><img class="pdfico" src="http://localhost/OnlineSchool/ste_includes/ste_content/img/pdf.png"/></a>
	<a href="#" title="Print"><img class="printico" src="http://localhost/OnlineSchool/ste_includes/ste_content/img/print.png"/></a>
	</div>
	<div class="title" align="center">
	<h2><b><?php echo $strDESC; ?></b></h2>
	</div>
		
	<hr class="featurette-divider">	
	<div class="reader">
		<?php include "ste_content/tuto/$tut"; ?>
	</div>
	<hr class="featurette-divider">
	
	</div>
	
	<div class="all_content">	
	<?php

	include "sidebar.php";

	?>
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

    <script src="ste_content/js/jquery.js"></script>
    <script src="ste_content/js/new.js"></script>
</body>

</html>