<?php
	session_start();
	require('config.php');
	require("include/classes/check_answers.php");
	require("include/classes/self_monitoring.php");
	$reponse = array();
	if((isset($_POST['choice']) and !empty($_POST['choice'])) OR isset($_POST['choice1']) and (isset($_POST['choice2']) and !empty($_POST['choice1']) and !empty($_POST['choice2']))){
	if(isset($_POST['compound'])){
		$ch1 = trim($_POST['choice1']);
		$ch2 = trim($_POST['choice2']);
		$a = $ch1."/".$ch2;
	}
	else{
			$a = trim($_POST['choice']);
	}
	
	$student = $_SESSION['user'];
	$question = $_POST['question'];
	$next = $_POST['next'];
	$chapter = $_POST['chapter'];
	$ob = new check_answers($mysqli);
	$attempt = new self_monitoring($mysqli);
	$ans = $ob->check_ans($a,$question);
	$frq_count =$attempt->frequency_count($question,$student);
	if($ans){
		$correct = 1;
		$flag =$attempt->save_attempt($correct,$student,$question);
		if($flag){
			$response = array("check"=>1,"msg"=>"Great...Please Wait Self Explanation page is loading.....","ch"=>$chapter,"q"=>$next);
		echo json_encode($response);
		}
		else{
			$response = array("check"=>3,"msg"=>"Some thing is going wrong.Please Attempt question Again","ch"=>$chapter,"q"=>$next);
			echo json_encode($response);
		}
		
	}
	else{
		$wrong = 2;
		$flag =$attempt->save_attempt($wrong,$student,$question);
		if($flag){
			if($frq_count[2][0] > 2){
				$response = array("check"=>0,"msg"=>"Please attempt again...You can use System Hint Or Click on Give Up to See Answer","frq"=>$frq_count[2][0]);
			}
			else{
					$response = array("check"=>0,"msg"=>"Please attempt again...You can use System Hint","frq"=>$frq_count[2][0]);
			}
			
			echo json_encode($response);
		}
		else{
			$response = array("check"=>3,"msg"=>"Some thing is going wrong.Please Attempt question Again");
		
		echo json_encode($response);
		}
		
	}
	
	}
	else{
		$response = array("check"=>4,"msg"=>"Please Write Answer in Input Field....");
		
		echo json_encode($response);
	}
?>