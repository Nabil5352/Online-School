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

$pid = $_GET['pid'];
$id = $_GET['id'];
$cmnt = "";

$SQL = mysql_query("SELECT * FROM `forum_topic` WHERE `post_id`='$pid'");
	
while($row = mysql_fetch_array($SQL)) {
$post_title = $row['post_title'];
$post = $row['post'];
$user_id = $row['user_id'];
$time = $row['time'];

$secondSQL = mysql_query("SELECT * FROM `user` WHERE `user_id`='$user_id'");
while($row = mysql_fetch_array($secondSQL)){
$post_user_name = $row['user_name'];
$country = $row['country'];
}

$thirdSQL = mysql_query("SELECT * FROM `forum_topic` WHERE `post_id`=$pid");
while($row = mysql_fetch_array($thirdSQL)){
$view = $row['views'];
}

$count_usr_post_sql = mysql_query("SELECT count(user_id) FROM `forum_topic` WHERE `user_id`='$user_id'");
$count_usr_post_num = mysql_result($count_usr_post_sql,0);

$_SESSION["views"] = $view;
 
if(isset($_SESSION['views'])){
    $_SESSION['views'] = $_SESSION['views']+ 1;
	mysql_query("UPDATE `forum_topic` SET `views`= ".$_SESSION['views']." WHERE `post_id`=$pid");
	}
else
    $_SESSION['views'] = 1;

$views =  $_SESSION['views']; 

$num_commentSQL = mysql_query("SELECT count(comment_id) FROM `forum_comment` WHERE `post_id`='$pid'");
$num_comment = mysql_result($num_commentSQL,0);

if(!$num_comment > 0){
$cmnt = "";
}


$cmntSQL = mysql_query("SELECT * FROM `forum_comment` WHERE `post_id`='$pid'");
while($row = mysql_fetch_array($cmntSQL)) {
$comment = $row['comment'];
$date = $row['date'];
$cmnt_user_id = $row['user'];

$usrSQL = mysql_query("SELECT * FROM `user` WHERE `user_id`='$cmnt_user_id'");
while($row = mysql_fetch_array($usrSQL)) {
$cmnt_user_name = $row['user_name'];
}

$cmnt .= "<p class='cmnt'>\"$comment\"</p>
			<p class='cmnt_info'><img class='cmnt_ico' src='../ste_content/img/Comments.png' title='Comments'>
			<strong>By:&nbsp;</strong><a href='#'>$cmnt_user_name</a> 
			<strong>&nbsp;&nbsp;On:&nbsp;</strong> $date</p>";

}			

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Online School | <?php echo $post_title; ?> </title>
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
  				<li class="active"> <?php echo $post_title; ?></li>
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
		<form action="reply.php?pid=<?php echo $pid; ?>&id=<?php echo $id; ?>" name="reply" id="reply" method="POST">
			<input class="replybtn" name="submit" type="submit" value="POSTREPLY!" />
		</form>
		<div class="detail_post">
		<div class="post_user">
			<img class='post_user_pic' src='../ste_content/img/sign_img/<?php echo $user_id; ?>.jpg'>
			<p class='post_user_detail'>
			<b><a href="#"><?php echo $post_user_name; ?></a></b><br/><br/>
			<strong>Posts:&nbsp;&nbsp;</strong><?php echo $count_usr_post_num; ?><br/>
			<strong>Country:&nbsp;&nbsp;</strong><?php echo $country; ?><br/>
			</p>
		
		</div>
			<?php
			
				echo "<p class='pst_title'>".$post_title."</p>";
				echo "<p><img class='pst_ico' src='../ste_content/img/Arrow-Up-64.png'>
						<strong>By: </strong>".$post_user_name."<strong> On </strong>".$time."</p>";
				echo "<br/><div class='pst'>".$post."</div>";
							
			?>	

		
		<div class="post_info">
			<div class="inside_post_info">
				<img class='cmnt_ico' src='../ste_content/img/Comments.png' title="Comments">
				&nbsp;<?php echo $num_comment; ?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<img class='cmnt_ico' src='../ste_content/img/People.ico' title="Viewed">
				&nbsp;<?php echo $views; ?>
			</div>
		</div>
		</div>
		
		<br/>
		
		<div class="cmnt_section">
			<img src="../ste_content/img/Arrow-cycle.png" width="25" height="25"/>
			&nbsp;<span class="cmnt_text"><b>Comments:</b></span>
			<div class="cmnt_Inside">
			&nbsp;&nbsp;&nbsp;
				<?php echo $cmnt; ?>
			</div>	
		</div>
		
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