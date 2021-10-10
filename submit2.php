<?php
	error_reporting(E_ALL);
	session_start();
	if(!(isset($_SESSION['user']))){
			header('location:register.php');
			exit();
	}
if(!(empty($_POST))){

	require('config.php');
	//$_POST = array_map('mysql_real_escape_string', $_POST);
	$exp = $_POST['explanation'];
	
		require("include/classes/self_explain.php");
		require("include/classes/self_monitoring.php");
		$ob = new self_monitoring($mysqli);
		$q = $_POST['qs_id'];
		$ch = $_POST['ch'];
		$qs_id = $ob->get_question_id($q,$ch);
		$selfexp = new self_explain($mysqli);
		$student = $_SESSION['user'];
		$self_explanation = $selfexp->set_self_exp($exp,$qs_id,$student);
		if($self_explanation){
			header("location:self_monitoring.php?ch=$ch&q=$q");
		}
		else{
			echo ("<script type='text/javascript'>window.location.href ='selfExplanation.php?ch=$ch&q=$q&msg=Please Self explain again..Some error occurs'</script>");
		}			
}
else{
	header("location:index.php");
	exit();
}
?>