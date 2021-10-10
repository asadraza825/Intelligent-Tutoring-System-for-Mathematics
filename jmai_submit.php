<?php
session_start();
if(!(isset($_SESSION['user']))){
		header('location:register.php');
		exit();
}
require("config.php");
if(!(empty($_POST))){
	
					for($i =1 ; $i<=18;$i++){
						$key = "item".$i;
						$item = $_POST[$key];
						$std = $_SESSION['user'];
						$resource = mysqli_query($mysqli,"INSERT INTO jmai_score(student_id,item_id,score) VALUES($std,$i,$item)") or die(mysqli_error());
						if(!$resource) {echo "ERROR"; die;}
					}
				
				$session_status = mysqli_query($mysqli,"DELETE FROM status_url WHERE student_id = $std");// or die(mysql_error());
				if($session_status){
						//echo "<div class='content'><p><h3>Your Test Has Completed.</h3></p></div>";
						//session_destroy();
						echo "<script type='text/javascript'>window.alert('Your test has completed.')</script>";
						echo "<script type='text/javascript'>window.location='index.php'</script>";
				}			
					
	}
else{
	//header("location:mslq.php");
	echo "else";
	
	exit();
}
?>