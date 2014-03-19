<?php
//For sign_up process
if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['user_name']) &&isset($_POST['email']) && 
	isset($_POST['password']) && isset($_POST['country']) && isset($_POST['day']) && isset($_POST['Month']) && isset($_POST['year'])){
	
	include "../ste_content/connect.php";
	
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$user_name = $_POST['user_name'];
	
	
	$day = $_POST['day'];
	$month = $_POST['Month'];
	$year = $_POST['year'];
	$birth_date = "$day/$month/$year";
	
	$email = $_POST['email'];
	$country = $_POST['country'];
	$pass = $_POST['password'];

	$sql = mysql_query("INSERT INTO `user`(`first_name`, `last_name`, `user_name`, `date_of_birth`, `e_mail`, `country`, `password`, `log_in_time`) 
						VALUES ('$first_name','$last_name','$user_name','$birth_date','$email','$country','$pass',now())");

	if(!$sql){
	die(mysql_error());
	} 
	else if($sql){
	$id = mysql_insert_id();
	$newname = "$id.jpg";
	move_uploaded_file($_FILES['fileField']['tmp_name'],"../ste_content/img/sign_img/$newname");
	header('location:http://localhost/OnlineSchool/ste_includes/login/loginForm.php');
	exit();
	}	
}
	
?>
