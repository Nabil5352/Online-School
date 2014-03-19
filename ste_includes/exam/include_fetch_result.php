<?php
	$ques_id = $_POST['qid'];
	$exam_id = $_POST['exam_id'];
	$marks = $_POST['marks'];
	$input = $_POST['valueIn'];

	//fetching result code start	
	$url = 'http://localhost/OnlineSchool/ste_includes/exam/values.php';

    $post_data = array(
      'ques_id' => $ques_id,
      'exam_id' => $exam_id,
      'marks' => $marks,
      'input' => $input
      );

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

    $output = curl_exec($ch);

    curl_close($ch);

    $data = json_decode($output, true);

    $value = $data['answer'];
    $mrks = $data['marks'];
    $ans = $data['Cans'];
    $xm_id = $data['exam_id'];
    $qs_id = $data['ques_id'];
//fetching result code end
?>