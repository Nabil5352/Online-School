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
		
	}
}
}
else{
header('location:http://localhost/OnlineSchool/ste_includes/login/loginForm.php');
exit();
}
?>
<?php
include "../ste_content/connect.php";

$marks = $_GET['marks'];
$examID = $_GET['xmID'];
$count = "";

$countSQL = mysql_query("SELECT count(`ques_id`) FROM `questions` WHERE `exam_id`='$examID'");
$count = mysql_result($countSQL,0);

$totalMarks = $count;

$updateSQL = mysql_query("INSERT INTO `result_archive`(`user_id`, `exam_id`, `total_marks`, `obtained_marks`, `date_of_exam`) 
	VALUES ($id,'$examID',$totalMarks,$marks, now())");

header('location:index.php');
exit();	
?>