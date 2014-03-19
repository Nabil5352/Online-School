<?php
session_start();

$bar = "<a href='http://localhost/OnlineSchool/ste_includes/ste_content/login/index.php'><abbr title='Log In'> Log In | </abbr></a>
			<a href='http://localhost/OnlineSchool/ste_includes/ste_content/signup/sign_up_main.php'><abbr title='Sign-Up'> Sign Up </abbr></a>";
$OKbar = "";

if(isset($_SESSION["user"])&& isset($_SESSION["password"])){
	
$user = preg_replace('#[^0-9A-Za-z]#i','',$_SESSION["user"]);
$pass = preg_replace('#[^0-9A-Za-z]#i','',$_SESSION["password"]);

include "connect.php";

$sql = mysql_query("SELECT * from user Where user_name='$user' AND password='$pass' LIMIT 1");

if(mysql_num_rows($sql) > 0){

while($row = mysql_fetch_array($sql)) {
    $id = $row['user_id'];
    $username = $row['user_name'];
	$password = $row['password'];	
	}   
	
if(strcmp($username,$user)==0 && strcmp($password,$pass)==0)
	{
		$OKbar = "<a href='http://localhost/OnlineSchool/ste_includes/ste_content/login/update.php'><abbr title='Edit your account'> My Account | </abbr></a>
		<a href='http://localhost/OnlineSchool/ste_includes/ste_content/login/logout.php'><abbr title='Log Out'> Log Out </abbr></a>";
		$bar = "";
	}

}

}

?>

<?php
//Report Error
error_reporting(E_ALL);
ini_set('display_errors','1');
?>

<!doctype html>

<html>
	<head>
		<meta charset="utf-8">
		<title> Online School | About Us </title>
		<!--<link href="ste_includes/ste_content/css/global.css"/>-->
		<style>
			a:link{
			color: #1d1e1f; 
			text-decoration:none;
			}
			
			a:visited{
			color:#1d1e1f;
			text-decoration:none;
			}
			
			a:hover{
			color:#59212d;
			text-decoration:underline;
			}

		</style>
		<script src="../js/main.js"> </script>
		<link rel="shortcut icon" href="../img/favicon.ico">
		
	</head>
	
	<body>
	<div id="container">
 		<div id="header">
            <div style="background-color:#476675; width:1330px; height:155px;">	
				<!--<a href="index.php"><img src="ste_includes/ste_content/img/os.jpg" width="800" height="150" /></a>-->
				<h1 style="position:absolute;top:40px; left:1000px; color:#ccc;">It makes learning easier</h1>
				<div style="position:absolute;top:125px; left:1150px; color:#0c4855;">
					<?php 
					echo $bar;
					echo $OKbar; 
					?>
				</div>
            </div>
			
			<div style="background-color:grey; width:1330px; height:30px; text-align:center;">
			<a href="http://localhost/OnlineSchool/index.php"><abbr title="Home">Home |</abbr></a>
			<a href="http://localhost/OnlineSchool/ste_includes/video_category_list.php" ><abbr title="Video tutorials"> Video |</abbr></a>
			<a href="http://localhost/OnlineSchool/ste_includes/tuto_category_list.php" ><abbr title="Tutorials"> Tutorial |</abbr></a>
			<a href="http://localhost/OnlineSchool/ste_includes/ste_content/forum/index.php" ><abbr title="Discuss what you want"> Forum |</abbr></a>
			<a href="http://localhost/OnlineSchool/ste_includes/ste_content/exam/main.php" ><abbr title="Test your skill"> Exam Centre |</abbr></a>
			<a href="http://localhost/OnlineSchool/ste_includes/ste_content/results/show_result.php"><abbr title="View exam history"> Result Archive |</abbr></a>
			<a href="http://localhost/OnlineSchool/about_us.php"><abbr title="Who are the geniouses">About Us</abbr></a>
			</div>
			
		</div>	
		
		<div id="content">
		
		
		</div>
		
	</div>
	</body>
</html>