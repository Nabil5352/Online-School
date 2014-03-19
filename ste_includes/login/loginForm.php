<?php
session_start();

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
		header('location:http://localhost/OnlineSchool/');
		exit();
	}
}
}
?>
<?php
if(isset($_POST["username"])&& isset($_POST["password"])){
	
$username = preg_replace('#[^0-9A-Za-z]#i','',$_POST["username"]);
$password = preg_replace('#[^0-9A-Za-z]#i','',$_POST["password"]);

include "../ste_content/connect.php";

$sql = mysql_query("SELECT * from user Where user_name='$username' AND password='$password' LIMIT 1");

$row = mysql_num_rows($sql);

if($row>0){
	while($f_row = mysql_fetch_array($sql)){
		$id = $row["id"];
		}
		$_SESSION["id"]=$id;
		$_SESSION["user"]=$username;
		$_SESSION["password"]=$password;
		header("location: http://localhost/OnlineSchool/");
		exit;
	}
}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Log In</title>
		 <link href="../ste_content/css/login.css" rel="stylesheet">
		 <link rel="shortcut icon" href="../ste_content/img/favicon.ico">
	</head>
	<body class='body'>
		<form action="index.php" method='POST' class='form'>
			Username: &nbsp;&nbsp;<input type="text" name="username" id="username" size='18' maxlength='15' placeholder='username'>
			<br/>
			Password: &nbsp;&nbsp;&nbsp;<input type="password" name="password" id="password" size='18' maxlength='15' placeholder='password'>
			<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

			<input name='submit' type='submit' id='submit' value='Sign In'/>
			<br/><br/> 
			Don't have an account? &nbsp;<a href='http://localhost/OnlineSchool/ste_includes/signup/'>Sign Up</a>
		</form>
	</body>
</html>