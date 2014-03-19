<?php
include('../ste_content/connect.php');
if(isset($_POST['email'])){
$email=$_POST['email'];
$sql = mysql_query("SELECT * from user Where e_mail='$email'");

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

