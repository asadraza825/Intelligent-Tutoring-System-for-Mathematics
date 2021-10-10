<?php
session_start();
if((!empty($_POST))){
	require('config.php');
	require('include/classes/register.php');
	
	$register = new register();
	
	$success = $register->register_account($_POST);
	
	if($success){
			header('location:register.php?msg=success');
	}
	else{
		header('location:register.php?error1=fail');
	}
 }
else{
	header("location:register.php");
	
}
?>
