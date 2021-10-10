<?php
session_start();
//error_reporting(0);
if(!(empty($_POST))){
	require('config.php');
	require("include/classes/self_monitoring.php");
	$ob = new self_monitoring($mysqli);
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
	else{
	$exp = $_POST['explanation'];	
	}
	$prompt_id = $_POST['prompt_id'];
	$hint_id = $_POST['hint_id'];
	$q_id = $_POST['qs_id'];
	$ch = $_POST['ch_id'];
	$qs_id = $ob->get_question_id($q_id,$ch);
	$student_id = $_SESSION['user'];
	$q = mysqli_query($mysqli,"insert into self_monitoring(prompt_id,hint_id,self_explanation)values($prompt_id,$hint_id,'$exp')") or die(mysql_error());
	$self_monitoring = mysqli_insert_id($mysqli);
	$q1 = mysqli_query($mysqli,"insert into student_selfmonitoring(self_monitoring,student_id,qs_id) values($self_monitoring,$student_id,$qs_id)") or die(mysqli_error());

	if($q AND $q1){
	
		$chapter  = $_SESSION['ch'];
		$question = $_SESSION['q'];
		header("location:index.php?ch=$ch&q=$q_id");
		//echo ("<script type='text/javascript'>window.location.href ='index.php?ch=$ch&q=$q_id'</script>");
	}
	else{
		echo ("<script type='text/javascript'>window.location.href ='index.php?ch=$ch&q=$q_id'</script>");
	}
}
?>