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
    $id = $row['user_id'];
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

?>

<?php

include "../ste_content/connect.php";

$id = $_GET['id'];
$sid = $_GET['sid'];
$list = "";
$Subcategory_name="";

$SQL = mysql_query("SELECT * FROM `forum_topic` WHERE `Subcategory_id`='$sid'");
	
while($row = mysql_fetch_array($SQL)) {
$post_id = $row['post_id'];
$post_title = $row['post_title'];
$post = $row['post'];
$Subcategory_id = $row['Subcategory_id'];
$user_id = $row['user_id'];

$secondSQL = mysql_query("SELECT * FROM `forum_topic` WHERE `Subcategory_id`='$sid'&&`post_id`=$post_id");
while($row = mysql_fetch_array($secondSQL)){
$view = $row['views'];
}

$thirdSQL = mysql_query("SELECT * FROM `user` WHERE `user_id`='$user_id'");
while($row = mysql_fetch_array($thirdSQL)){
$user_name = $row['user_name'];
}

$fourthSQL = mysql_query("SELECT * FROM `subcategory` WHERE `Subcategory_id`='$sid' LIMIT 1");
while($row = mysql_fetch_array($fourthSQL)){
	$Subcategory_name = $row['Subcategory_name'];
}

$sub_str = substr($post, 0, 80);

$list .= "<tr>
	    <td width='81' height='54' class='window0' align='center'><img class='windowIcon' src='../ste_content/img/post.png'alt='ico'></td>
	    <td width='443' class='window'>
			<p class='post_title'><a href='view_post_details.php?pid=$post_id&id=$id'>$post_title</a></p>
			<p class='post'>$sub_str.....</p>
		</td>
	    <td width='98' class='window0' align='center'><a href='#'>$user_name</a></td>
	    <td width='99' class='window' align='center'>$view</td>
      </tr>";

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Online School | List of Posts </title>
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
				<li><a href="http://localhost/OnlineSchool/ste_includes/forum/topic.php?id=<?php echo $id; ?>" title="Topics"> Topics </a>
				<span class="divider">&#187;</span></li>
  				<li class="active"> List of Posts </li>
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
	
	<div class="body">
	<div class="title">
	<img src="../ste_content/img/djja.png" width="25" height="25"/>
	&nbsp;<span class="Welcometext"><b>Welcome</b></span>
	</div>
		<div class="Inside">
		&nbsp;&nbsp;&nbsp;
			<?php echo $welbar; ?>
		<div class="">
		&nbsp;&nbsp;&nbsp;
		Online school forum Top news: <a href="#">Something</a>
		</div>
		</div>	
		
		<div class="middleBar">
		</div>
	
	<div class="middleBar">
	
	</div>
		
	<div class="table2">
	<table width="100%" border="0">
	  <tr>
	    <td width="700" height="41" class="tablehead">
		  <img class="headerIcon" src="../ste_content/img/arrow_64.png"alt="ico">
		  &nbsp;&nbsp;<span class="headerText"><b>Tag:</b>&nbsp;&nbsp;<?php echo $Subcategory_name; ?></span>
		</td>
		<td width="101" height="40" class="tablehead">&nbsp;</td>
		<td width="102" height="40" class="tablehead"><a href='new_post.php?id=<?php echo $id; ?>'>Add new post</a></td>
      </tr>
	  <tr>
	    <td width="532" class="tablehead2" align="center">Title</td>
	    <td width="101" class="tablehead2" align="center">Posted By</td>
	    <td width="102" class="tablehead2" align="center">Hit</td>
      </tr>
	  </table>
	  <table width="100%" border="1">
      
	  <?php
	  echo $list;
	  ?>
	  
	  </table>
	</div>
	
	<br/><br/><br/><br/><br/>
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

    <script src="../ste_content/js/jquery.js"></script>
    <script src="../ste_content/js/new.js"></script>


</body>
</html>