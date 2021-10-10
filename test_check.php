<?php
	session_start();
	if(!(isset($_SESSION['user']))){
		header("location:index.php");
		session_destroy();
		exit();
	}
	require('config.php');
	require("include/classes/check_answers.php");
	require("include/classes/self_monitoring.php");
	$reponse = array();
	if(isset($_POST['choice']) and !empty($_POST['choice'])){
	
	$a = $_POST['choice'];
	$student = $_SESSION['user'];

	$question = $_POST['question'];
	$chapter = $_POST['chapter'];
	$ob = new check_answers($mysqli);
	$attempt = new self_monitoring($mysqli);
	$ans = $ob->check_test_ans($a,$question);
	if($ans){
		$correct = 1;
		
	}
	else{
		$correct = 0;
	}
		$flag1 =$attempt->update_question($student,$question,$a);
		$flag2 =$attempt->save_result($question,$correct,$student);
		if($flag1 and $flag2){
			$next_question = $question +1;
			$response = array("check"=>1,"qid"=>$next_question,"ch"=>$chapter);
		
		echo json_encode($response);
		}
		else{
			$response = array("check"=>3);
			echo json_encode($response);
		}
		
	}
	
	else{
		$response = array("check"=>4);
		
		echo json_encode($response);
	}
	
?>