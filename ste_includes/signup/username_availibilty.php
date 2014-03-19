<?php
include('../ste_content/connect.php');
if(isset($_POST['user_name'])){
$user_name=$_POST['user_name'];
$sql = mysql_query("SELECT * from user Where user_name='$user_name'");

$row = mysql_num_rows($sql);

if($row>0){   
		$js['message']='worked';
	}
	else{
	$js['message']='Not worked';
	}
 echo json_encode($js);
}
?>