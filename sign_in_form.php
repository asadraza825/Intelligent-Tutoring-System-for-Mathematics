<?php
//error_reporting(E_ALL);
session_start();
if(!(empty($_POST))){
	require('config.php');
	require("include/classes/login.php");
	//$_POST =  array_map('mysql_real_escape_string',$_POST);
	$user = trim($_POST['user']);
	$pass = trim($_POST['pass']);
	
	$q =     mysqli_query($mysqli,"select * from student where  user_name = '".$user."' AND  password = '".$pass."'");
	$count = mysqli_num_rows($q) or die(mysqli_error());
	
	if($count){

		while($rows = $q->fetch_array()){
				$_SESSION['user']  = $rows['student_id'];
				$_SESSION['name']  = $rows['student_name'];
				$ob = new login($GLOBALS['mysqli']);
				$ob->save_login($rows['student_id']);
				
				
		} 
		$std = $_SESSION['user'];
		$status = $ob->get_url($std);
	
		if($status){
				
				/*if($status[0] == 1){
					$chapter = $status[2];
					$question = $status[3];
					header("location:index.php?ch=$chapter&q=$question");
					exit();
				}
				else if($status[0] == 2){
					$chapter =  $status[2];
					$question = $status[3];
					header("location:index.php?status=$chapter");
					exit();
				}
				else if($status[1] == 1){
					$chapter = $status[2];
					$question = $status[3];
					header("location:problems.php?ch=$chapter&q=$question");
					exit();
				}
				else if($status[1] == 1){
					$chapter = $status[2];
					$question = $status[3];
					header("location:problems.php?ch=$chapter&q=$question");
					exit();
				}*/
				header("location:$status");
					exit();
				
		}
		else{
				$ob->save_url($std);
				header("location:index.php");
		}
		
	}
	else{
		header('location:register.php?login=error');
	}
 }
else{
	header("location:index.php");
}
?>
