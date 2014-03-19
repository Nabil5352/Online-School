<?php
session_start();

$bar = "<form action='../login/index.php' name='myForm' id='myForm' method='POST'>
			<input name='username' type='text' id='username' size='15' maxlength='15'/>
			<input name='password' type='password' id='password' size='15' maxlength='15'/>
			<br/>
			<input name='submit' type='submit' value='Sign In'/> 
			&nbsp;&nbsp;Don't have an account? &nbsp;<a href='#'>Sign Up</a>
			</form>";
$OKbar = "";
$welbar = "New to the forum? <a href='#'>Sign up</a> to get in touch with many experts and developers.";

if(isset($_SESSION["user"])&& isset($_SESSION["password"])){
	
$user = preg_replace('#[^0-9A-Za-z]#i','',$_SESSION["user"]);
$pass = preg_replace('#[^0-9A-Za-z]#i','',$_SESSION["password"]);

include "../ste_content/connect.php";

$sql = mysql_query("SELECT * from user Where user_name='$user' AND password='$pass' LIMIT 1");

if(mysql_num_rows($sql) > 0){

while($row = mysql_fetch_array($sql)) {
    $user_id = $row['user_id'];
    $username = $row['user_name'];
	$password = $row['password'];
	$log_in_time = $row['log_in_time'];	
	}   
	
if(strcmp($username,$user)==0 && strcmp($password,$pass)==0)
	{
		$OKbar = "<p class='logUsr'>Logged in as <a href='#'>$username</a> ( <a href='../login/logout.php'> Log Out </a> )</p>";
		$bar = "";
		$welbar = "Your last visit was : <strong><i>$log_in_time</i></strong>";
	}
}

}
else{
	header("location:http://localhost/OnlineSchool/ste_includes/login/loginForm.php");
	exit();
}

?>
<?php

if(isset($_POST['topic']) && isset($_POST['title']) && isset($_POST['myTextArea'])){

	$id = $_POST['id'];
	
	$topic_id = $_POST['topic'];
	$title = $_POST['title'];
	$details = $_POST['myTextArea'];

	include "../ste_content/connect.php";

	$sql = mysql_query("INSERT INTO `forum_topic`(`user_id`, `Subcategory_id`, `post_title`, `post`, `views`, `time`)
					VALUES ('$user_id','$topic_id','$title','$details','0',now())");

	if(!$sql){
	die('Error:Cannot insert data into database.');
	} 
	
	header("location:topic.php?id=$id");
	exit();	
}

?>
<?php
include "../ste_content/connect.php";

$id = $_GET['id'];

$SQL = mysql_query("SELECT * FROM `subcategory` WHERE `Category_id`=$id");
$tp_list="";
	
while($row = mysql_fetch_array($SQL)) {
$Subcategory_id = $row['Subcategory_id'];
$subcategory_name = $row['Subcategory_name'];

$tp_list_up = "Section:&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name='topic' id='topic'>";
$tp_list .= "<option value=$Subcategory_id>$subcategory_name</option>";	
$tp_list_down = "</select>";
$action = "new_post.php";

$titles = "<p>Entry title:&nbsp;&nbsp;&nbsp;&nbsp;<input name='title' id='title' type='text' size='80' maxlength='80' /></p>
	<p>Entry body:&nbsp;&nbsp;<br/>";
	
$hidden = "<input name='id' type='hidden' id='id' value='$id'>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Online School | New Post </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	
    <link href="../ste_content/css/new.css" rel="stylesheet">
    <link href="../ste_content/css/new-responsive.css" rel="stylesheet">
	<link href="../ste_content/css/index.css" rel="stylesheet">
	<link href="../ste_content/css/new.css" rel="stylesheet" />
	<link href="../ste_content/css/new-responsive.css" rel="stylesheet" /> 
	<link href="../ste_content/css/forum_topic.css" rel="stylesheet">	

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav icon -->
    <link rel="shortcut icon" href="../ste_content/img/favicon.ico">
</head>

<body>


	<div class="header">
		&nbsp;<a href="http://localhost/OnlineSchool/ste_includes/forum/"><img class="header_image" src="../ste_content/img/forum_icon.jpg"></a>
		
		<div class="container-fluid">
		<div class="row-fluid">
		<nav class="span12">
			<ul class="breadcrumb">
  				<li><a href="http://localhost/OnlineSchool/ste_includes/forum/" title="Forum home"> Board Index </a>
				<span class="divider">&#187;</span></li>
  				<li class="active"> New Post </li>
			</ul>
		</nav>
		</div>
		</div>
		
		<div class="middleBar">
		</div>
		
		<div class="SubHeader2">
			<?php
			
			echo $bar;
			echo $OKbar;
			
			?>
		</div>
	</div>
	
	<div class="body_content">
		<?php
		include "Editor.php";
		?>
	</div>
	
	<br/><br/><br/><br/><br/>
	<div class="footer">
	 <!-- FOOTER -->
	 <fieldset>
      <footer align="center" style="background-color:#27292a; height:40px;">
       <p> <span class="footer_text">&copy; 2012 Online School.</span> &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>
	  </fieldset>
	</div>
	</div>

<!-- javascript -->
    <!-- ================================================== -->

    <script src="../ste_content/js/jquery.js"></script>
    <script src="../ste_content/js/new.js"></script>


</body>
</html>