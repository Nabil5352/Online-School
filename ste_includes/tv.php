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
	$listID = $_GET['List_id'];
	$list = "";
	$ive = '';

	$rs = mysql_query("SELECT * FROM `video_links` WHERE `Subcategory_id`='$subID' ORDER BY `Subcategory_id`");

	while($row = mysql_fetch_array($rs)) {
	$strTitle = $row['List_title'];
	$id = $row['List_id'];
	
	if(strcmp($listID,$id)==0){
        $ive = 'active';
    } 
	
	$strLink = "<a href = 'tv.php?List_id=" . $row['List_id'] . "&&Subcategory_id=". $row['Subcategory_id']."'>" . $strTitle . "</a>";
	
	$list .= "<li class='$ive'><a href='#'> $strLink </a></li>" ;	
		
	$ive=''; 
	} 
?>
<?php
	$viewSQL = mysql_query("SELECT * FROM `video_links` WHERE `List_id`='$listID' ORDER BY `Subcategory_id`");

	while ($row = mysql_fetch_array($viewSQL)) {
		$view = $row['views'];
	}
	
	$_SESSION["views"]=$view;

	if(isset($_SESSION['views'])){
    $_SESSION['views'] = $_SESSION['views']+ 1;
	mysql_query("UPDATE `video_links` SET `views`=".$_SESSION['views']." WHERE `List_id`='$listID'");
	}
	else{
		$_SESSION['views'] = 1;
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Online School | Playlist </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	
    <link href="ste_content/css/new.css" rel="stylesheet">
    <link href="ste_content/css/new-responsive.css" rel="stylesheet">
	<link href="ste_content/css/index.css" rel="stylesheet">
	<link href="ste_content/css/tv.css" rel="stylesheet">	

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
	<div class="container">
	<div class="container-fluid">
	<div class="row-fluid">
		<nav class="span12">
			<ul class="breadcrumb">
			<li><a href="http://localhost/OnlineSchool/index.php" title="Home"><span class="brd_name">Home</span></a>
			<span class="divider">&#187;</span></li>
			<li><a href="http://localhost/OnlineSchool/ste_includes/video.php" title="Video tutorials"><span class="brd_name">Video</span></a>
			<span class="divider">&#187;</span></li>
			<li><a href="http://localhost/OnlineSchool/ste_includes/video_tuto_list.php?Subcategory_id=<?php echo $subID; ?>" title="Video playlist"><span class="brd_name">Playlist</span></a>
			<span class="divider">&#187;</span></li>
			<li class="active">Playing</li>			
			<?php 
				echo $bar;
				echo $OKbar; 
			?>	
			</ul>
			
		</nav>
	</div>
	</div>
	
      <div class="span3 bs-docs-sidebar">
        <ul class="nav nav-list bs-docs-sidenav">
          <?php echo $list; ?>
        </ul>
      </div>
	
	
	<hr class="featurette-divider">	
		<div id="tv" align="center">
			<div id="console">
				<div id="videoDiv">
					<video controls autoplay src="<?php echo "ste_content/vid/vid".$_GET["List_id"].".ogv"; ?>" width="480" height="360"
						poster="ste_content/img/eye.jpg" id="video">
					</video>
				</div>
				<!--<div id="dashboard">
					<div id="effects">
						<a class="effect" id="normal"></a>
						<a class="effect" id="western"></a>
						<a class="effect" id="noir"></a>
						<a class="effect" id="scifi"></a>
					</div>
				
					<div id="controls">
						<a class="control" id="play"></a>
						<a class="control" id="pause"></a>
						<a class="control" id="loop"></a>
						<a class="control" id="mute"></a>
					</div>
				
					<div id="videoSelection">
						<a class="videoSelection" id="video1"></a>
						<a class="videoSelection" id="video2"></a>
					</div>
				</div>
				-->
			</div>
		</div>
	<hr class="featurette-divider">
	
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