<?php
	include "../ste_content/connect.php";

	//Receiving passed values
	$ques_id = $_POST['ques_id'];
	$exam_id = $_POST['exam_id'];
	$marks = $_POST['marks'];
	$input = $_POST['input'];
	
	//Query for checking answer
	$ansSQL = mysql_query("SELECT * FROM `questions` WHERE '$ques_id'-1 = `ques_id`");          

	while($row = mysql_fetch_array($ansSQL)) {
    $ans = $row['answer'];          
	}  
 	
	//Comparing user's answer and database answer
	if(strcmp($input,$ans)==0)
	{
		$answer = 'OK';
		//Increment marks if answer is OK
		$marks = $marks+1;
		$Cans = "O";
	}
	else
	{
		$answer ='NOK';
		//Marks remain same if answer is not OK
		$marks = $marks+0;
	
		//Query and displaying correct answer	
		$CorrectAnsSQL = mysql_query("SELECT * FROM `questions_options` WHERE `option_id`='$ans'");	
		while($row = mysql_fetch_array($CorrectAnsSQL)) {
		$Cans = $row['options']; 	
		} 
	
	}				
	
	$output =  array(
		'answer' => $answer,
      	'marks' => $marks,
      	'Cans' => $Cans,
      	'exam_id' => $exam_id,
      	'ques_id' => $ques_id
      	);	

	echo json_encode($output);		
?>