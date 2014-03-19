<?php
session_start();

if(isset($_SESSION["user"])&& isset($_SESSION["password"])){
	
$user = preg_replace('#[^0-9A-Za-z]#i','',$_SESSION["user"]);
$pass = preg_replace('#[^0-9A-Za-z]#i','',$_SESSION["password"]);

include "../connect.php";

$sql = mysql_query("SELECT * from user Where user_name='$user' AND password='$pass' LIMIT 1");

if(mysql_num_rows($sql) > 0){

while($row = mysql_fetch_array($sql)) {
    $id = $row['user_id'];
	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
    $username = $row['user_name'];
	$password = $row['password'];
	$e_mail = $row['e_mail'];
	$country = $row['country'];
	
	}   
	
if(strcmp($username,$user)==0 && strcmp($password,$pass)==0)
	{
		$OKbar = "<a href='http://localhost/OnlineSchool/ste_includes/ste_content/login/update.php'><abbr title='Edit your account'> My Account | </abbr></a>
		<a href='http://localhost/OnlineSchool/ste_includes/ste_content/login/logout.php'><abbr title='Log Out'> Log Out </abbr></a>";
		$bar = "";
	}
}

}
else{
	header('location:http://localhost/OnlineSchool/index.php');
}

?>

<?php
if(isset($_POST['first_name']) || isset($_POST['last_name']) || isset($_POST['user_name']) || isset($_POST['e_mail']) || isset($_POST['password']) || isset($_POST['country'])){
$first_name = mysql_real_escape_string($_POST['first_name']);
$last_name = mysql_real_escape_string($_POST['last_name']);
$user_name = mysql_real_escape_string($_POST['user_name']);
$e_mail = $_POST['e_mail'];
$password = mysql_real_escape_string($_POST['password']);
$country = mysql_real_escape_string($_POST['country']);

$sql = mysql_query("UPDATE `user` SET `first_name`='$first_name',`last_name`='$last_name',`user_name`='$user_name',
`e_mail`='$e_mail',`country`='$country',`password`='$password' WHERE `user_id`='$id'");

header("location:http://localhost/OnlineSchool/ste_includes/ste_content/login/index.php");
exit();
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
		<title> Online School | My Account </title>
		<!--<link href="ste_includes/ste_content/css/global.css"/>-->
		<style>
			a:link{
			color: #0c4855; 
			text-decoration:none;
			}
			
			a:visited{
			color:#0c4855;
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
            <div style="background-color:#476675; width:1345px; height:155px;">	
				<a href="index.php"><img src="../img/os.jpg" width="800" height="150" /></a>
				<h1 style="position:absolute;top:40px; left:1000px; color:#ccc;">It makes learning easier</h1>
				<div style="position:absolute;top:125px; left:1150px; color:#0c4855;">
					<?php 
					echo $bar;
					echo $OKbar; 
					?>
				</div>
            </div>
			
			<div style="background-color:grey; width:1345px; height:30px; text-align:center;">
			<a href="ste_includes/video_category_list.php" ><abbr title="Video tutorials">Video |</abbr></a>
			<a href="ste_includes/tuto_category_list.php" <abbr title="Tutorials"> Tutorial |</abbr></a>
			<a href="http://localhost/OnlineSchool/ste_includes/ste_content/forum/index.php" ><abbr title="Discuss what you want"> Forum |</abbr></a>
			<a href="http://localhost/OnlineSchool/ste_includes/ste_content/exam/main.php"><abbr title="Test your skill"> Exam Centre |</abbr></a>
			<a href="http://localhost/OnlineSchool/ste_includes/ste_content/results/show_result.php"><abbr title="View exam history"> Result Archive |</abbr></a>
			<a href="http://localhost/OnlineSchool/ste_includes/about_us.php" ><abbr title="Who are the geniouses">About Us</abbr></a>
			</div>
			
		</div>	
				
				
		<div id="content" >
			<div id="header1" align="center">
				<h1 id="sign">Update Account</h1>
			 </div>
			
		<form action="update.php" enctype="multipart/form-data" name="myForm" id="myForm" method="POST">
	
			<table width="0%" border="0" cellspacing="0" cellpadding="0" align="center">
			
			<tr>
				<td width="20%">First Name:</td>
				<td><input type="text" name="first_name" id="first_name" value="<?php echo $first_name; ?>"/> </td>	
			</tr>
			<tr>
				<td width="20%">Last Name:</td>
				<td><input type="text" name="last_name" id="last_name" value="<?php echo $last_name; ?>"/> </td>	
			</tr>
			<tr>
				<td width="20%">User Name:</td>
				<td><input type="text" name="user_name" id="user_name" value="<?php echo $username;?>"/> </td>	
			</tr>
			<tr>
				<td width="20%">E-mail*:</td>
				<td><input type="text" name="e_mail" id="e_mail" value="<?php echo $e_mail; ?>"/> </td>
			</tr>
			<tr>
				<td width="20%">Password*:</td>
				<td><input type="text" name="password" id="password" value="<?php echo $password; ?>"/> </td>
			</tr>
			<tr>
				<td width="20%">Country:</td>
				<td>
					<select name="country" palceholder="country" id="firstname">
						<option value="Bangladesh">Bangladesh</option>
						<option value="Afghanistan">Afghanistan</option>
						<option value="India">India</option>
						<option value="Pakistan">Pakistan</option>
						<option value="Sri-Lanka">Sri-Lanka</option>
						<option value="Maldives">Maldives</option>
					</select>&nbsp;&nbsp;<i>Previous:&nbsp;<b></i><?php echo $country; ?></b>
				</td>
			</tr>
			<tr>
				<td width="20%">&nbsp;</td>
				<td width="80%"><label> <input name="button" type="submit" id="button" value="Update/Edit!"></label></td>
			</tr>
        
			</table>
	
		</form>
										 

						  
						    
		</div>
	</div>		
	
</body>

</html>