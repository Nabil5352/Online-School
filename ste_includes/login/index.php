<?php
session_start();


if(isset($_POST["username"])&& isset($_POST["password"])){
	
$username = preg_replace('#[^0-9A-Za-z]#i','',$_POST["username"]);
$password = preg_replace('#[^0-9A-Za-z]#i','',$_POST["password"]);

include "../ste_content/connect.php";

$sql = mysql_query("SELECT * from user Where user_name='$username' AND password='$password' LIMIT 1");

$row = mysql_num_rows($sql);

if($row>0){
	while($f_row = mysql_fetch_array($sql)){
		$id = $f_row["user_id"];
		}
		$_SESSION["id"]=$id;
		$_SESSION["user"]=$username;
		$_SESSION["password"]=$password;
		$SQL = mysql_query("UPDATE `user` SET `log_in_time`=now() WHERE `user_id`=$id");
		header("location: http://localhost/OnlineSchool/");
		exit;
	}
else{
	header("location: http://localhost/OnlineSchool/ste_includes/login/loginForm.php");	
	exit;
	}

}

?>