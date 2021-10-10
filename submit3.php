<?php
session_start();
error_reporting(E_ALL);
if(!(isset($_SESSION['user']))){
		header('location:register.php');
		exit();
}
else if(!(empty($_POST))){
	require('config.php');
	require("include/classes/self_monitoring.php");
	@$ob = new self_monitoring($mysqli);
	//$_POST = array_map('mysql_real_escape_string', $_POST);
	if(isset($_POST['se_steps'])){
	$steps_length = $_POST['se_steps'];
	for($i = 1;$i<=$steps_length;$i++){
	$step = "step".$i;
	$exp .=$_POST[$step];
	if($i != $steps_length){
		$exp .= ",";
	}
}
}
	
	$q_id = $_POST['qs_id'];
	$ch = $_POST['ch_id'];
	$qs_id = $ob->get_question_id($q_id,$ch);
	$student_id = $_SESSION['user'];
	$giveup = 3;
	$q = $ob->save_attempt_with_se($giveup,$student_id,$q_id,$exp);
	if($q){
	
		$chapter  = $_SESSION['ch'];
		$question = $_SESSION['q'];
		header("location:selfExplanation.php?ch=$ch&q=$q_id");
	}
	else{
		echo ("<script type='text/javascript'>window.location.href ='index.php?ch=$ch&q=$q_id'</script>");
	}
}
else if(isset($_GET['action'])){
	require('config.php');
	require("include/classes/self_monitoring.php");
	@$ob = new self_monitoring($mysqli);
	$student = $_SESSION['user'];
	$ch = $_GET['ch'];
	$q = $_GET['q'];
	$question = $ob->get_question_id($q,$ch);
	$giveup = 4;
	$ob->save_attempt($giveup,$student,$question);
	header("location:selfExplanation.php?ch=$ch&q=$q");
}
?>